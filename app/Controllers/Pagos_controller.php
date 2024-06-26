<?php
namespace App\Controllers;
Use App\Models\Cuota_model;
Use App\Models\Cuota_detalle_model;
Use App\Models\Pago_model;


Use CodeIgniter\I18n\Time;
Use CodeIgniter\Controller;

class Pagos_controller extends Controller {
    public function crear_factura($id = 0) {
        $facCabecera = new Factura_cabecera_model();
        $facProducto = new Factura_producto_model();
        $productoModel = new Productos_model();

        $cart = \Config\Services::cart();
        $carrito = $cart->contents();
                
        $myTime = new Time('now', 'America/Argentina/Buenos_Aires');
        $total = $cart->total();
        
        $facCabecera->save([
            'fecha'       => $myTime,
            'usuario_id'  => $id,
            'total_venta' => $total
        ]);

        $db = \Config\Database::connect();
        $factura_cabecera = $db->query('SELECT id FROM factura_cabecera');

        if ($factura_cabecera->getNumRows() > 0) {
            $id_factura = $factura_cabecera->getNumRows();
        } else {
            $id_factura = 1;
        }

        foreach($carrito as $row) {
            $facProducto->save([
                'factura_id'  => $id_factura,
                'producto_id' => $row['id'],
                'cantidad'    => $row['qty'],
                'precio'      => $row['price'],
                'total'       => $row['subtotal']
            ]);
            $producto = $productoModel->where('id', $row['id'])->first();
            $stock = ['stock' => ($producto['stock'] - $row['qty'])];
            $productoModel->update($row['id'], $stock);
        }
        $cart->destroy();
        $db->close();
        session()->setFlashdata('msg', 'La compra se ha realizado con éxito.');
        return redirect()->to('/Carrito');
    }

    public function realizar_pago() {
        $pago_model = new Pago_model();
        $cuota_model = new Cuota_model();
        helper('date');

        $session = session();
        $cliente = $session->get('pago_cliente');
        $cuota = $session->get('pago_cuota');
        $cuota_pago = $cuota_model->where('id_cuota', $cuota)->first();
        $monto = $cuota_pago['cuota_monto'];

        $myTime = new Time('now', 'America/Argentina/Buenos_Aires');

        $pago_model->save([
                'id_cuota'      => $cuota,
                'dni_cliente'   => $cliente,
                'id_tipo_pago'    => $this->request->getVar('id_tipo_pago'),
                'pago_fecha'      => $myTime,
                'pago_monto'       => $monto
            ]);

        session()->setFlashdata('msg', 'El Pago se ha realizado con exito.');
        return redirect()->to('/Pago-Empleado-Cuota');
    }
}
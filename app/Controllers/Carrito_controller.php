<?php
namespace App\Controllers;
Use App\Models\Productos_model;
Use App\Models\Categorias_model;
Use CodeIgniter\Controller;

class Carrito_controller extends Controller {
    public function carrito_add($id = 0) {
        $formModel = new Productos_model();
        $producto = $formModel->where('id', $id)->first();
        
        $cart = \Config\Services::cart();
        $carrito = $cart->contents();

        if (count($carrito) > 0) {
            foreach($carrito as $row) {
                if ($row['id'] == $id) {
                    if ($row['qty'] < $producto['stock_min']) {
                        $data = array(
                            'rowid' => $row['rowid'],
                            'qty'   => ($row['qty'] + 1)
                        );
                        $cart->update($data);
                        session()->setFlashdata('msg', 'Producto añadido al carrito');
                        return redirect()->back()->withInput();
                    } else {
                        session()->setFlashdata('msg', 'Solo se permite comprar ' .$producto['stock_min'] .' camisetas de ' .$producto['club'] .' a la vez.');
                        return redirect()->back()->withInput();
                    }                    
                }
            }
        }
        $cart->insert(array(
            'id'         => $producto['id'],
            'qty'        => 1,
            'price'      => $producto['precio'],
            'name'       => $producto['club'],
            'imagen_ext' => $producto['imagen_ext']
        ));

        session()->setFlashdata('msg', 'Producto añadido al carrito');
        return redirect()->back()->withInput();
    }

    public function carrito_delete($id = null) {
        $cart = \Config\Services::cart();
        $cart->remove($id);
        return redirect()->to('/Carrito');
    }

    public function carrito_destroy() {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('/Carrito');
    }
}
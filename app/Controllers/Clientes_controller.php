<?php
namespace App\Controllers;
Use App\Models\Cliente_model;
Use CodeIgniter\Controller;

class Clientes_controller extends Controller {
    public function __construct() {
        helper(['form', 'url']);
    }
    
    public function filtrar($filtro = null) {
        $formModel = new Consultas_model();
        if ($filtro == 'Sin-Contestar') {
            $filtros['filtro'] = $formModel->where('contestado', 'NO')->findAll();
        } else {
            $filtros['filtro'] = $formModel->where('contestado', 'SI')->findAll();
        }
        
        $data['titulo']='CRUD de Consultas | TuFutbol';

        echo view('head', $data);
        echo view('menu');
        echo view('CRUD-Consultas', $filtros);
        echo view('footer');
    }

    public function delete($id = 0) {
        $formModel = new Consultas_model();
        $consulta = $formModel->where('id', $id)->first();

        if ($consulta['contestado'] == 'SI') {
            $contestado = ['contestado' => 'NO'];
        } else {
            $contestado = ['contestado' => 'SI'];
        }        

        $formModel->update($id, $contestado);

        return redirect()->to('/CRUD-Consultas');
    }

    public function validacion_crear() {
        helper('form', 'url');
        $input = $this->validate([
            'cliente_nombre'   => [
                'label'  => 'nombre',
                'rules'  => 'required|min_length[1]|max_length[30]',
                'errors' => [
                    'required'   => 'Introduzca el {field} del cliente.',
                    'min_length'  => 'El {field} debe tener más de {param} caracteres.',
                    'max_length' => 'El {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'cliente_apellido'    => [
                    'label'  => 'apellido',
                    'rules'  => 'required|min_length[5]|max_length[30]',
                    'errors' => [
                        'required'    => 'Introduzca el {field} del cliente.',
                        'min_length'  => 'El {field} debe tener más de {param} caracteres.',
                        'max_length'  => 'El {field} debe tener menos de {param} caracteres.'
                    ]
                ],
            'dni_cliente'   => [
                'label'  => 'dni',
                'rules'  => 'required|min_length[4]|max_length[9]|is_unique[cliente.dni_cliente]',
                'errors' => [
                    'required'   => 'Introduzca el {field} del cliente.',
                    'min_length' => 'El {field} debe tener más de {param} caracteres.',
                    'max_length' => 'El {field} debe tener menos de {param} caracteres.',
                    'is_unique'   => 'El Dni ({value}) ya está registrado.'
                ]
            ],
        ]);

        $formModel = new Cliente_model();

        if (!$input) {
            $data['titulo']='Gestion De Pagos | Crear Cliente';
            echo view('head', $data);
            echo view('menu');
            echo view('crear-cliente', ['validation' => $this->validator]);
        } else {
            $formModel->save([
                'dni_cliente' => $this->request->getVar('dni_cliente'),
                'cliente_nombre'   => $this->request->getVar('cliente_nombre'),
                'cliente_apellido'   => $this->request->getVar('cliente_apellido')
            ]);            

            session()->setFlashdata('msg', 'El cliente ha sido creado con exito.');

            return redirect()->to('/Pago-Empleado-Cliente');
        }
    }
}
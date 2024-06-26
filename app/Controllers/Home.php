<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        $data['titulo']='Gestion De Pagos';

        echo view('head', $data);
        echo view('menu');
        echo view('ingresar');
    }
    public function crud_cursos() {
        $data['titulo']='Gestion De Pagos | Cursos';
        echo view('head', $data);
        echo view('menu');
        echo view('CRUD-Cursos');
    }
    public function crud_usuarios() {
        $data['titulo']='Gestion De Pagos | Usuarios';
        echo view('head', $data);
        echo view('menu');
        echo view('CRUD-Usuarios');
    }
    public function crud_clientes() {
        $data['titulo']='Gestion De Pagos | Clientes';
        echo view('head', $data);
        echo view('menu');
        echo view('CRUD-Clientes');
    }
    public function cuotas_alumno() {
        $data['titulo']='Gestion De Pagos | Cuotas Alumno';

        echo view('head', $data);
        echo view('menu');
        echo view('cuotas-alumno');
    }
    public function ingresar() {
        $data['titulo']='Gestion De Pagos | Ingresar';

        echo view('head', $data);
        echo view('menu');
        echo view('CRUD-Usuarios');
    }    
    public function crear_usuario() {
        $data['titulo']='Gestion De Pagos | Crear Usuario';

        echo view('head', $data);
        echo view('menu');
        echo view('crear-cuenta');
    }
    public function crear_curso() {
        $data['titulo']='Gestion De Pagos | Crear Curso';

        echo view('head', $data);
        echo view('menu');
        echo view('crear-curso');
    }
    public function crear_cliente() {
        $data['titulo']='Gestion De Pagos | Crear Curso';

        echo view('head', $data);
        echo view('menu');
        echo view('crear-cliente');
    }
    public function registrar_pago() {
        $data['titulo']='Gestion De Pagos | Registrar Pago';

        echo view('head', $data);
        echo view('menu');
        echo view('registrar-pago');
    }
    public function dashboard() {
        $data['titulo']='Gestion De Pagos | Bienvenido';

        echo view('head', $data);
        echo view('menu');
        echo view('dashboard');
    }
}

<?php
namespace App\Controllers;
Use App\Models\Productos_model;
Use App\Models\Curso_model;
Use App\Models\Idioma_model;
Use App\Models\Categorias_model;
Use CodeIgniter\Controller;

class Cursos_controller extends Controller {
    public function __construct() {
        helper(['form', 'url']);
    }

    public function filtrar($filtro = 0) {
        $formModel = new Productos_model();
        $filtros['filtro'] = $formModel->where('categoria_id', $filtro)->findAll();
        $data['titulo']='Productos | TuFutbol';
        
        echo view('head', $data);
        echo view('menu');
        echo view('productos', $filtros);
        echo view('footer');
    }
    
    public function edit($id = 0) {
        $formModel = new Curso_model();
        $curso_buscar['curso_buscar'] = $formModel->where('id_curso', $id)->first();

        $data['titulo']='Gestion De Pagos | Modificar Curso';

        echo view('head', $data);
        echo view('menu');
        echo view('modificar-curso', $curso_buscar);
    }

    public function delete($id = 0) {
        $formModel = new Curso_model();
        $curso = $formModel->where('id_curso', $id)->first();

        if ($curso['curso_habilitado'] == 'SI') {
            $eliminado = ['curso_habilitado' => 'NO'];
        } else {
            $eliminado = ['curso_habilitado' => 'SI'];
        }        

        $formModel->update($id, $eliminado);

        return redirect()->to('/CRUD-Cursos');
    }

    public function editValidation($id = 0) {
        helper(['form', 'url', 'file']);        
        $input = $this->validate([
            'curso_descripcion'   => [
                'label'  => 'nombre',
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca el {field}.',
                    'max_length' => 'El {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'curso_precio' => [
                'label'  => 'precio',
                'rules'  => 'required|numeric|max_length[7]',
                'errors' => [
                    'required'   => 'Introduzca el {field}.',
                    'numeric'    => 'Su {field} debe expresarse en números.',
                    'max_length' => 'Su {field} no es realista.'
                ]
            ]
        ]);

        $formModel = new Curso_model();

        if (!$input) {
            $data['titulo']='Gestion De Pagos | Modificar Curso';

            echo view('head', $data);
            echo view('menu');
            echo view('crear-curso', ['validation' => $this->validator]);
        } else {
            $formModel->save([
                'curso_descripcion' => $this->request->getVar('curso_descripcion'),
                'id_idioma'    => $this->request->getVar('curso_idioma'),
                'curso_precio' => $this->request->getVar('curso_precio'),
            ]);

            session()->setFlashdata('msg', 'Los cambios han sido guardados con éxito');

            return redirect()->to('/CRUD-Cursos');
        }
    }

    public function formValidation() {
        helper('form', 'url');
        $input = $this->validate([
            'curso_descripcion'   => [
                'label'  => 'nombre',
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca el {field}.',
                    'max_length' => 'El {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'curso_precio' => [
                'label'  => 'precio',
                'rules'  => 'required|numeric|max_length[7]',
                'errors' => [
                    'required'   => 'Introduzca el {field}.',
                    'numeric'    => 'Su {field} debe expresarse en números.',
                    'max_length' => 'Su {field} no es realista.'
                ]
            ]
        ]);

        $formModel = new Curso_model();

        if (!$input) {
            $data['titulo']='Gestion De Pagos | Crear Curso';

            echo view('head', $data);
            echo view('menu');
            echo view('crear-curso', ['validation' => $this->validator]);
        } else {
            $formModel->save([
                'curso_descripcion' => $this->request->getVar('curso_descripcion'),
                'id_idioma'    => $this->request->getVar('curso_idioma'),
                'curso_precio' => $this->request->getVar('curso_precio'),
            ]);

            session()->setFlashdata('msg', 'El curso ha sido creado con éxito');

            return redirect()->to('/crear-curso');
        }
    }
}
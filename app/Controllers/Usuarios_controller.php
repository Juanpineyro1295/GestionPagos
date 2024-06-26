<?php
namespace App\Controllers;
Use App\Models\Usuarios_model;
Use CodeIgniter\Controller;

class Usuarios_controller extends Controller {
    public function __construct() {
        helper(['form', 'url']);
    }

    public function buscar_alumno() {
        $formModel = new Usuarios_model();
        $usuario['usuario'] = $formModel->where('usuario_dni', $this->request->getVar('alumno_dni'))->first();

        $data['titulo']='Modificar Usuario | TuFutbol';

        if ($usuario['usuario']){
            $this->session->set_userdata('pago_alumno', $usuario["id_usuario"]);

            echo view('head', $data);
            echo view('menu');
            echo view('cuotas-empleado', $usuario);
        } else {
            session()->setFlashdata('msg', 'El alumno no existe');

            echo view('head', $data);
            echo view('menu');
            echo view('buscar-alumno');            
        }
    }
    
    public function edit($id = 0) {
        $formModel = new Usuarios_model();

        $usuario = $formModel->where('id_usuario', $id)->first();
        $usuario_buscar['usuario_buscar'] = $formModel->where('id_usuario', $id)->first();

        $data['titulo']='Gestion De Pagos'.$usuario['id_usuario'].' | Modificar Usuario';

        echo view('head', $data);
        echo view('menu');
        echo view('modificar-usuario', $usuario_buscar);
    }

    public function delete($id = 0) {
        $formModel = new Usuarios_model();
        $usuario = $formModel->where('id_usuario', $id)->first();

        if ($usuario['usuario_habilitado'] == 'S') {
            $baja = ['usuario_habilitado' => 'N'];
        } else {
            $baja = ['usuario_habilitado' => 'S'];
        }        

        $formModel->update($id, $baja);
        session()->setFlashdata('msg', 'Los cambios han sido guardados con éxito');

        return redirect()->to('/CRUD-Usuarios');
    }

    public function editValidation($id = 0) {
        helper('form', 'url');
        $formModel = new Usuarios_model();
        $usuario['usuario_buscar'] = $formModel->where('id_usuario', $id)->first();
        
        if (!(empty($this->request->getVar('pass')))) {
            $input = $this->validate([
                'usuario_nombre'   => [
                    'label'  => 'nombre',
                    'rules'  => 'required|min_length[2]|max_length[25]',
                    'errors' => [
                        'required'   => 'Introduzca su {field}.',
                        'min_length' => 'Su {field} debe tener menos de {param} caracteres.',
                        'max_length' => 'Su {field} debe tener más de {param} caracteres.'
                    ]
                ],
                'usuario_apellido' => [
                    'label'  => 'apellido',
                    'rules'  => 'required|min_length[2]|max_length[25]',
                    'errors' => [
                        'required'   => 'Introduzca su {field}.',
                        'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                        'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                    ]
                ],
            'usuario_dni'   => [
                'label'  => 'dni',
                'rules'  => 'required|min_length[4]|max_length[9]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.',
                    'is_unique'   => 'El Dni ({value}) ya está registrado.'
                ]
            ],
            'usuario_telefono' => [
                'label'  => 'telefono',
                'rules'  => 'max_length[15]',
                'errors' => [
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
                'usuario_email'    => [
                    'label'  => 'correo electrónico',
                    'rules'  => 'required|min_length[5]|max_length[40]|valid_email',
                    'errors' => [
                        'required'    => 'Introduzca su {field}.',
                        'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                        'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                        'valid_email' => 'El correo electronico ({value}) no es válido.',
                        'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
                    ]
                ],
                'usuario_contraseña'     => [
                    'label'  => 'contraseña',
                    'rules'  => 'required|min_length[10]|max_length[25]',
                    'errors' => [
                        'required'   => 'Introduzca su {field}.',
                        'min_length' => 'La {field} debe tener más de {param} caracteres.',
                        'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                    ]
                ],
                'passconf' => [
                    'label'  => 'contraseña confirmar',
                    'rules'  => 'required|matches[pass]',
                    'errors' => [
                    'required' => 'Introduzca su contraseña.',
                    'matches'  => 'Las contraseñas no coinciden.'
                    ]
                ]
            ]);
        } else {
            $input = $this->validate([
                'usuario_nombre'   => [
                    'label'  => 'nombre',
                    'rules'  => 'required|min_length[2]|max_length[25]',
                    'errors' => [
                        'required'   => 'Introduzca su {field}.',
                        'min_length' => 'Su {field} debe tener menos de {param} caracteres.',
                        'max_length' => 'Su {field} debe tener más de {param} caracteres.'
                    ]
                ],
                'usuario_apellido' => [
                    'label'  => 'apellido',
                    'rules'  => 'required|min_length[2]|max_length[25]',
                    'errors' => [
                        'required'   => 'Introduzca su {field}.',
                        'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                        'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                    ]
                ],
            'usuario_dni'   => [
                'label'  => 'dni',
                'rules'  => 'required|min_length[4]|max_length[9]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.',
                    'is_unique'   => 'El Dni ({value}) ya está registrado.'
                ]
            ],
            'usuario_telefono' => [
                'label'  => 'telefono',
                'rules'  => 'max_length[15]',
                'errors' => [
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
                'usuario_email'    => [
                    'label'  => 'correo electrónico',
                    'rules'  => 'required|min_length[5]|max_length[40]|valid_email',
                    'errors' => [
                        'required'    => 'Introduzca su {field}.',
                        'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                        'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                        'valid_email' => 'El correo electronico ({value}) no es válido.',
                        'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
                    ]
                ],
                ]);
        }
        if (!$input) {
            $data['titulo']='Gestion De Pagos | Modificar Usuario';
            echo view('head', $data);
            echo view('menu');
            echo view('modificar-usuario', $usuario, ['validation' => $this->validator]);

        } else {
            if (!(empty($this->request->getVar('pass')))) {
                $data = [                
                'id_tipo_usuario'  => $this->request->getVar('id_tipo_usuario'),
                'usuario_dni'      => $this->request->getVar('usuario_dni'),
                'usuario_nombre'   => $this->request->getVar('usuario_nombre'),
                'usuario_apellido' => $this->request->getVar('usuario_apellido'),
                'usuario_telefono' => $this->request->getVar('usuario_telefono'),
                'usuario_sexo'     => $this->request->getVar('usuario_sexo'),
                'usuario_email'    => $this->request->getVar('usuario_email'),
                'usuario_contraseña'=> password_hash($this->request->getVar('usuario_contraseña'), PASSWORD_DEFAULT)
                ];               
            } else {
                $data = [                
                'id_tipo_usuario'  => $this->request->getVar('id_tipo_usuario'),
                'usuario_dni'      => $this->request->getVar('usuario_dni'),
                'usuario_nombre'   => $this->request->getVar('usuario_nombre'),
                'usuario_apellido' => $this->request->getVar('usuario_apellido'),
                'usuario_telefono' => $this->request->getVar('usuario_telefono'),
                'usuario_sexo'     => $this->request->getVar('usuario_sexo'),
                'usuario_email'    => $this->request->getVar('usuario_email'),
                ];
            }

            $formModel->update($id, $data);
            session()->setFlashdata('msg', 'Los cambios han sido guardados con éxito');
            return redirect()->to('/CRUD-Usuarios');
        }
    }

    public function formValidation() {
        helper('form', 'url');
        $input = $this->validate([
            'id_tipo_usuario'   => [
                'label'  => 'tipo de usuario',
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Seleccione su {field}.'
                ]
            ],
            'usuario_dni'   => [
                'label'  => 'dni',
                'rules'  => 'required|min_length[4]|max_length[9]|is_unique[usuario.usuario_dni]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.',
                    'is_unique'   => 'El Dni ({value}) ya está registrado.'
                ]
            ],
            'usuario_nombre'   => [
                'label'  => 'nombre',
                'rules'  => 'required|min_length[2]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'usuario_apellido' => [
                'label'  => 'apellido',
                'rules'  => 'required|min_length[2]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'usuario_telefono' => [
                'label'  => 'telefono',
                'rules'  => 'max_length[15]',
                'errors' => [
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'usuario_email'    => [
                'label'  => 'correo electrónico',
                'rules'  => 'required|min_length[5]|max_length[40]|valid_email|is_unique[usuario.usuario_email]',
                'errors' => [
                    'required'    => 'Introduzca su {field}.',
                    'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                    'valid_email' => 'El correo electronico ({value}) no es válido.',
                    'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
                ]
            ],
            'usuario_contraseña'     => [
                'label'  => 'contraseña',
                'rules'  => 'required|min_length[10]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ],

            'usuario_contraseña'     => [
                'label'  => 'contraseña',
                'rules'  => 'required|min_length[10]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ],
                'passconf' => [
                    'label'  => 'contraseña confirmar',
                    'rules'  => 'required|matches[usuario_contraseña]',
                    'errors' => [
                    'required' => 'Introduzca su contraseña.',
                    'matches'  => 'Las contraseñas no coinciden.'
                    ]
                ]
        ]);

        $formModel = new Usuarios_model();

        if (!$input) {            
            session()->setFlashdata('msg', 'Error');
            $data['titulo']='Gestion De Pagos | Crear Cuenta';
            echo view('head', $data);
            echo view('menu');
            echo view('crear-cuenta', ['validation' => $this->validator]);
        }
        else {
            $formModel->save([                
                'id_tipo_usuario'  => $this->request->getVar('id_tipo_usuario'),
                'usuario_dni'      => $this->request->getVar('usuario_dni'),
                'usuario_nombre'   => $this->request->getVar('usuario_nombre'),
                'usuario_apellido' => $this->request->getVar('usuario_apellido'),
                'usuario_telefono' => $this->request->getVar('usuario_telefono'),
                'usuario_sexo'     => $this->request->getVar('usuario_sexo'),
                'usuario_email'    => $this->request->getVar('usuario_email'),
                'usuario_contraseña'=> password_hash($this->request->getVar('usuario_contraseña'), PASSWORD_DEFAULT)
            ]);

            session()->setFlashdata('msg', 'El usuario ha sido creado con éxito');

            return redirect()->to('/Crear-Cuenta');
        }
    }
}
<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\Usuarios_model;
  
class SigninController extends Controller {
    public function index() {
        helper(['form']);
        echo view('ingresar');
    }

    public function iniciar_sesion() {
        $session   = session();
        $userModel = new Usuarios_model();
        $email     = $this->request->getVar('usuario_email');
        $password  = $this->request->getVar('usuario_contraseña');
        
        $data = $userModel->where('usuario_email', $email)->first();
        
        if($data){
            $pass = $data['usuario_contraseña'];

            if (password_verify($password, $pass)) {
                $ses_data = [
                    'id_usuario'      => $data['id_usuario'],
                    'id_tipo_usuario' => $data['id_tipo_usuario'],
                    'usuario_nombre'  => $data['usuario_nombre'],
                    'usuario_email'   => $data['usuario_email'],
                    'pago_alumno'   => '',                  
                    'pago_cuota'   => '',
                    'pago_cliente' => '',
                    'isLoggedIn' => TRUE
                ];

                if ($data['usuario_habilitado'] == 'N') {
                    $session->setFlashdata('msg', 'Este Usuario se encuentra de baja.');
                    return redirect()->to('/Ingresar');
                } else {
                    $session->set($ses_data);
                    return redirect()->to('/Dashboard');
                }
            } else {
                $session->setFlashdata('msg', 'La contraseña es incorrecta.');
                return redirect()->to('/Ingresar');
            }
        } else {
            $session->setFlashdata('msg', 'El email no esta registrado.');
            return redirect()->to('/Ingresar');
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
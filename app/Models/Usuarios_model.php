<?php
namespace App\Models;
use CodeIgniter\Model;
class Usuarios_model extends Model {
	protected $table = 'usuario';
	protected $primaryKey = 'id_usuario';
	protected $allowedFields = ['id_tipo_usuario', 'usuario_dni', 'usuario_nombre', 'usuario_apellido', 'usuario_telefono', 'usuario_sexo', 'usuario_email', 'usuario_contraseña', 'usuario_habilitado'];
}
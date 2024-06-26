<?php
namespace App\Models;
use CodeIgniter\Model;
class Tipo_usuario_model extends Model {
	protected $table = 'tipo_usuario';
	protected $primaryKey = 'id_tipo_usuario';
	protected $allowedFields = ['tipo_usuario_descripcion'];
}
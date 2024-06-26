<?php
namespace App\Models;
use CodeIgniter\Model;
class Cliente_model extends Model {
	protected $table = 'cliente';
	protected $primaryKey = 'dni_cliente';
	protected $allowedFields = ['cliente_nombre', 'cliente_apellido'];
}
<?php
namespace App\Models;
use CodeIgniter\Model;
class Cuota_model extends Model {
	protected $table = 'cuota';
	protected $primaryKey = 'id_cuota';
	protected $allowedFields = ['id_usuario_alumno', 'cuota_fecha', 'cuota_monto'];
}
<?php
namespace App\Models;
use CodeIgniter\Model;
class Cuota_detalle_model extends Model {
	protected $table = 'cuota_detalle';
	protected $primaryKey = 'id_cuota_detalle';
	protected $allowedFields = ['id_cuota', 'id_curso', 'cuota_detalle_monto'];
}
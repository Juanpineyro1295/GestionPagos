<?php
namespace App\Models;
use CodeIgniter\Model;
class Pago_model extends Model {
	protected $table = 'pago';
	protected $primaryKey = 'id_pago';
	protected $allowedFields = ['id_pago', 'id_cuota', 'dni_cliente', 'id_tipo_pago', 'pago_fecha', 'pago_hora', 'pago_monto'];
}
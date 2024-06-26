<?php
namespace App\Models;
use CodeIgniter\Model;
class Idioma_model extends Model {
	protected $table = 'idioma';
	protected $primaryKey = 'id_idioma';
	protected $allowedFields = ['idioma_descripcion'];
}
<?php
namespace App\Models;
use CodeIgniter\Model;
class Curso_model extends Model {
	protected $table = 'curso';
	protected $primaryKey = 'id_curso';
	protected $allowedFields = ['id_idioma', 'curso_descripcion', 'curso_precio', 'curso_habilitado'];
}
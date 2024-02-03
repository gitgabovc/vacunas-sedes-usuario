<?php

namespace App\Models;

use CodeIgniter\Model;

class EstablecimientosModel extends Model
{
    protected $table ='establecimiento';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'municipio_id',
        'nombre',
        'codigo',
        'add_at',
        'mod_at',
        'del_at'
    ];

    public function getEstablecimientocodigo($codigo)
	{
		$db = \Config\Database::connect();
        $builder = $db->table('establecimiento as e');
        $builder->select('*');
        $builder->from('establecimiento');
		$builder->where('codigo',$codigo);
        return $this->first();
	}
}
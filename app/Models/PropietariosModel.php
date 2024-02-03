<?php

namespace App\Models;

use CodeIgniter\Model;

class PropietariosModel extends Model
{
    protected $table ='propietario';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'ci',
        'nombre',
        'direccion',
        'telefono',
        'password',
        'add_at',
        'mod_at',
        'del_at'
    ];

    public function getPropietario($id)
	{
		$db = \Config\Database::connect();
        $builder = $db->table('propietario as p');
        $builder->select('*');
		$builder->from('propietario');
		return $this->where('id',$id)->first($id);
	}
}
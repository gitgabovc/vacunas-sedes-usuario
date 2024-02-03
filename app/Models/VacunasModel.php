<?php

namespace App\Models;

use CodeIgniter\Model;

class VacunasModel extends Model
{
    protected $table ='vacunas';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'fechas_id',
        'mascota_id',
        'vacunado',
        'brigadas_id',
        'fecha_vacuna',
        'add_at',
        'mod_at',
        'del_at'
    ];

    public function getVacunaPorMascota($idfechas, $idmascota)
	{
		$db = \Config\Database::connect();
        $builder = $db->table('vacunas as v');
        $builder->select('*');
        $builder->from('vacunas');
        $builder->where('fechas_id',$idfechas);
		return $this->where('mascota_id',$idmascota)->first($idmascota);
        /* return $this->first(); */
	}
}
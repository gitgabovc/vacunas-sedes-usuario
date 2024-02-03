<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class FechasModel extends Model
{
    protected $table ='fechas';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'campana_id',
        'establecimiento_id',
        'add_at',
        'mod_at',
        'del_at'
    ];

    public function getFechaCampanaPorEstablecimiento($responsable_establecimiento)
	{
		$date = new Time('now');
        
        $db = \Config\Database::connect();
        $builder = $db->table('fechas');
        $builder->select('*');
        $builder->join('campana', 'campana.id = fechas.campana_id');
        $builder->where('campana.vigente', 'S');
        $builder->where('campana.fechafin >=', $date);
        return $this->where('fechas.establecimiento_id',$responsable_establecimiento)->first($responsable_establecimiento);
	}
}
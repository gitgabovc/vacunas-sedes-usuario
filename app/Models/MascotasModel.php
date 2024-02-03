<?php

namespace App\Models;

use CodeIgniter\Model;

class MascotasModel extends Model
{
    protected $table ='mascota';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'propietario_id',
        'raza_id',
        'nombre',
        'sexo',
        'edad_meses',
        'edad_anios',
        'foto',
        'color',
        'tipo',
        'estado',
        'add_at',
        'mod_at',
        'del_at'
    ];

    public function listamascotas($id)
    {        		
        /* $this->db->query("SELECT R.descripcion, M.nombre, M.sexo, M.edad, M.color, M.tipo
                        FROM mascota M
                        JOIN raza R ON R.id=M.raza_id
                        JOIN propietario P ON P.id=M.propietario_id
                        WHERE P.id=$id");
        return $this->db->get(); */

        /* return $this->findAll(); */

        /* $db = \Config\Database::connect();
        $builder = $db->table('mascota as m');
        $builder->select('r.descripcion, m.nombre, m.sexo, m.edad, m.color, m.tipo');
        $builder->join('raza as r','r.id','m.raza_id');
        $builder->join('propietario as p','p.id','m.propietario_id');
		$builder->get('p.id',$id);
		$query = $builder->get(); */
    }

    public function getMascota($id)
	{
		$db = \Config\Database::connect();
        $builder = $db->table('mascota as m');
        $builder->select('*');
		$builder->from('mascota');
		return $this->where('id',$id)->first($id);
	}

    public function getVacunaMascota($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mascota as M');
        $builder->select('M.id, R.descripcion, M.nombre, M.sexo, M.edad_meses, M.edad_anios, M.foto, M.color, M.tipo, F.fecha');
		$builder->from('mascota as M');
        $builder->join('raza as R','R.id = M.raza_id');
        $builder->join('propietario as P','P.id = M.propietario_id');
        $builder->join('vacunas as V','V.mascota_id = M.id');
        $builder->join('fechas as F','F.id = V.fechas_id');
		return $this->where('id',$id)->first($id);
    }

}
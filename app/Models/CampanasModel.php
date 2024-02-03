<?php

namespace App\Models;

use CodeIgniter\Model;

class CampanasModel extends Model
{
    protected $table ='campana';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'tipo_campana_id',
        'descripcion',
        'gestion',
        'fechaini',
        'fechafin',
        'vigente',
        'add_at',
        'mod_at',
        'del_at'
    ];    
}
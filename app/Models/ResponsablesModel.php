<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponsablesModel extends Model
{
    protected $table ='responsable';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'nombre',
        'ci',
        'password',
        'establecimiento_id',
        'add_at',
        'mod_at',
        'del_at'
    ];
}
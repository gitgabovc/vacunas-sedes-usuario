<?php

namespace App\Models;

use CodeIgniter\Model;

class BrigadasModel extends Model
{
    protected $table ='brigadas';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'responsable_id',
        'nrobrigada',
        'lugar',
        'fechas_id',
        'dosis',
        'add_at',
        'mod_at',
        'del_at'
    ];
}
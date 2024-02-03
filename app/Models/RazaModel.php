<?php

namespace App\Models;

use CodeIgniter\Model;

class RazaModel extends Model
{
    protected $table ='raza';
    protected $primarykey = 'id';
    protected $allowedFields = ['descripcion','add_at','mod_at','del_at'];
}
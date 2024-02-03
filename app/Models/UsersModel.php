<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table ='usuario';
    protected $primarykey = 'id';
    protected $allowedFields = ['nombre', 'usuario', 'password'];
}
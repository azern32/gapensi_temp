<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_User extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'uuid';

    protected $useAutoIncrement = false;
    protected $allowedFields = ['uuid', 'level', 'username', 'password', 'nama_asli', 'jabatan'];
}
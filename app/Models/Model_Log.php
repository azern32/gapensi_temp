<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Log extends Model
{
    protected $table      = 'daftar_log';
    protected $primaryKey = 'timestamp';

    protected $useAutoIncrement = false;
    protected $allowedFields = ['timestamp', 'tanggal_kejadian', 'nominal', 'akun_sumber','akun_tujuan','akun_hutang'];
}
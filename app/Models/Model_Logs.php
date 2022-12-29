<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Logs extends Model {
    protected $table      = 'daftar_logs';
    protected $primaryKey = 'timestamp';
    
    protected $useAutoIncrement = false;
    protected $allowedFields = ['timestamp', 'tanggal_kejadian', 'keterangan', 'nominal', 'akun_sumber', 'akun_tujuan','akun_hutang'];

}

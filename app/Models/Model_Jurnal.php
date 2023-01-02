<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Jurnal extends Model {
    protected $table      = 'jurnal';
    protected $primaryKey = 'uuid';
    
    protected $useAutoIncrement = false;
    protected $allowedFields = ['uuid', 'timestamp', 'tanggal', 'keterangan', 'nilai', 'akun_debet', 'akun_kredit'];
}

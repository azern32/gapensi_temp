<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Rekening extends Model {
    protected $table      = 'daftar_akun';
    protected $primaryKey = 'uuid';

    protected $useAutoIncrement = false;
    protected $allowedFields = ['uuid', 'kode_akun', 'nama_akun', 'debit', 'kredit', 'saldo'];

}

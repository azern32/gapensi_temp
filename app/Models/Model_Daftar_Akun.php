<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Daftar_Akun extends Model {
    protected $table      = 'daftar_akun';
    protected $primaryKey = 'uuid';

    protected $useAutoIncrement = false;
    protected $allowedFields = ['uuid', 'kode_akun', 'nama_akun', 'debit', 'kredit', 'saldo'];
    /*
        uuid = generated by javascript crypto.randomUUID()
        kode_akun = input form text
        nama_akun = input form text
        debit = counted by function
        kredit = counted by function
        saldo = counted by function
    */

}

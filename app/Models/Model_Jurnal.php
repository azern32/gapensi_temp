<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Jurnal extends Model {
    protected $table      = 'jurnal';
    protected $primaryKey = 'uuid';
    
    protected $useAutoIncrement = false;
    protected $allowedFields = ['uuid', 'referensi', 'timestamp', 'tanggal', 'tahun', 'keterangan', 'nilai', 'akun_debet', 'akun_kredit', 'bukti_transaksi'];
    /*
        uuid = generated by javascript crypto.randomUUID()
        timestamp = generated by javascript Date.now()
        referensi = input form text
        tanggal = input form date
        keterangan = input form text
        nilai = input form number
        akun_debet = uuid, input form select
        akun_kredit = uuid, input form select
        bukti_transaksi = filename, input form file
    */
}

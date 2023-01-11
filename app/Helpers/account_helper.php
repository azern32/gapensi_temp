<?php 

use App\Models\Model_Daftar_Akun;

function getAccountName($uuid){
    $db_akun = new Model_Daftar_Akun();
    $theAccount = $db_akun->where('uuid', $uuid)->first() ?? null;

    if (!$theAccount) {
        return theAccount;
    }
    
    return $theAccount['nama_akun'];   
}


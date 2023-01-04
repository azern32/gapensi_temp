<?php 

use App\Models\Model_User;

function is_user_exist($username){
    // Connect ke database user
    $db_user = new Model_User();
    
    // Periksa jika username ditemukan, jika tidak, nilai menjadi null
    $theUser = $db_user->where('username', $username)->first() ?? null;
    
    // var_dump($username);
    // Kembalikan nilai sebagai boolean
    return $theUser;
}

function authenticate($username, $password){
    $db_user = new Model_User();
    
    // Default value untuk hasil
    $result = false;

    // Periksa jika username ditemukan
    $theUser = $db_user->where('username', $username)->first() ?? null;

    // Jika username ditemukan, periksa passwordnya
    if ($theUser != null) {
        $result = $theUser['password'] == $password ? true : false;
    }

    // Kembalikan nilai sebagai array atau false
    return $result;
}


function newSession($var){
    $session = session();
    return $session->set([
        'uuid'=>$var['uuid'],
        'username'=>$var['username'],
        'level'=>$var['level'],
        'nama_asli'=>$var['nama_asli'],
        'jabatan'=>$var['jabatan'],
    ]);
}

function quickFlash($text){
    $session = session();
    $session->setFlashdata('flash', $text);
}

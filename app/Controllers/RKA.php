<?php

namespace App\Controllers;

use App\Models\Model_RKA_Tahunan;
use App\Models\Model_RKA_Jangka_Panjang;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

// helper('auth');
class RKA extends ResourceController{
    use RequestTrait;
    use ResponseTrait;
    protected $helpers = ['form', 'auth', 'account', 'filesystem'];


    public function add($tipe){
        if ($tipe == 'tahunan') {
            $rka = new Model_RKA_Tahunan();
        } elseif ($tipe == 'jangka_panjang') {
            $rka = new Model_RKA_Jangka_Panjang();
        }

        // Upload Files ========================
        // Buat pathnya
        $path = ROOTPATH.'public/uploads/'.$tipe.'/'.$_POST['uuid'];
        // Buat foldernya
        mkdir($path, 0777, true);
        if ($_FILES["file"]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["file"]["tmp_name"];
            $namafile = $_FILES['file']['name'];
            $ext = pathinfo($namafile, PATHINFO_EXTENSION);
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            // $name = basename($_FILES["file"]["name"]);
            $name = $_POST["judul_file"].'.'.$ext;
            move_uploaded_file($tmp_name, "$path/$name");
        }

        $rka->insert($_POST);

        return $this->respond($_POST);
    }

    public function detail($tipe, $uuid){
        if ($tipe == 'tahunan') {
            $rka = new Model_RKA_Tahunan();
        } elseif ($tipe == 'jangka_panjang') {
            $rka = new Model_RKA_Jangka_Panjang();
        }

        $selected = $rka->find($uuid);

        return $this->respond($selected);
    }

    public function list($tipe){
        if ($tipe == 'tahunan') {
            $rka = new Model_RKA_Tahunan();
        } elseif ($tipe == 'jangka_panjang') {
            $rka = new Model_RKA_Jangka_Panjang();
        }

        return $this->respond( $rka->findAll());
    }



}

<?php

namespace App\Controllers;

use App\Models\Model_Daftar_Akun;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Rekening extends ResourceController{
class Rekening extends BaseController{
    use RequestTrait;
    use ResponseTrait;
    

    public function view(){
        $session = session();

        // Cek jika ada level user
        // Jika tidak, kembali ke login
        if (!$session->get('level')) {
            return redirect()->to('/login');
        }

        // Simpan dalam variabel dependency dan session
        $tohead['dependencies'] = $this->dependency('head');
        $tohead['session'] = $session->get();
        
        // Simpan dalam variabel dependency dan session        
        return view('layout/layout_rekening', $tohead);
    }

    public function list(){
        $akun_rekening = new Model_Daftar_Akun();
        return $this->respond($akun_rekening->findAll());
    }

    public function add(){
        $akun_rekening = new Model_Daftar_Akun();
        $akun_rekening->insert($_POST);
        $response = [
            'status'   => 200,
            'body'     => $_POST,
            'messages' => [
                'success' => 'Ta tambah ji',
            ]
        ];

        return $this->respond($response);
    }

    public function edit($uuid = null){
        $akun_rekening = new Model_Daftar_Akun();

        if ($uuid == null) {
            $response = [
                'status'   => 403,
                'body'     => 'Jangan main-main lah bos',
                'messages' => [
                    'uuid' => $uuid,
                ]
            ];
            return $this->respond($response);
        }

        $data['toEdit'] = $akun_rekening->where('uuid', $uuid)->first();
        $data['req'] = $_POST;
        
        $akun_rekening->update($uuid, $_POST);

        $response = [
            'status'   => 200,
            'body'     => $data,
            'messages' => [
                'uuid' => $uuid,
                'post data' => $_POST,
            ]
        ];
        return $this->respond($response);
    }



    
    // -----------------------------------------------------------------
    
    
    // Fungsi dependency untuk listkan dependency yang dibutuhkan sama halaman
    public function dependency($part=''){
        if ($part == 'head') {
            return [
                'css' => [
                    'Roboto Fonts'=>'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
                    'Material Icons'=>'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
                    'Font Awesome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                    'adminlte'=>base_url()."/adminlte/css/adminlte.min.css",
                    'myown'=>base_url()."/css/myown.css",
                ],
                'js'  => [
                    'jquery'=>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js",
                    'polyfills'=>"https://polyfill.io/v3/polyfill.min.js?features=Array.prototype.find,Promise,Object.assign",
                    'popper'=>"https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js",
                    'bootstrap'=>"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js",                    'adminlte'=>base_url().'/adminlte/js/adminlte.min.js',
                    'adminlte'=>base_url().'/adminlte/js/adminlte.min.js',
                    'myown'=>base_url()."/js/myown.js",

                ]
            ];
        } 
        
        return [
                // 'chartJS'=>"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js",
                'myown' => base_url()."/js/myown.js",
        ];
    

    }
}
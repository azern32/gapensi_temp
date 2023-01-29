<?php

namespace App\Controllers;

use App\Models\Model_Daftar_Akun;
use App\Models\Model_Daftar_BS;
use App\Models\Model_Daftar_PL;
use App\Models\Model_Daftar_Tipe;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Rekening extends ResourceController{
class Akun extends BaseController{
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
        return view('layout/layout_akun', $tohead);
    }

    public function list($var){
        if ($var == 'tipe') {
            $list = new Model_Daftar_Tipe();
            $list = $list->orderBy('nama_tipe', 'asc');
        } elseif ($var == 'akun') {
            $list = new Model_Daftar_Akun();
            $list = $list->orderBy('kode_akun', 'asc');
        } elseif ($var == 'bs') {
            $list = new Model_Daftar_BS();
            $list = $list->orderBy('nama_bs', 'asc');
        } elseif ($var == 'pl') {
            $list = new Model_Daftar_PL();
            $list = $list->orderBy('nama_pl', 'asc');
        } else {
            return $this->respond(['message'=>'no database found']);
        }
        
        return $this->respond($list->findAll());
    }

    public function listlatest($var, $uuid){
        if ($var == 'tipe') {
            $list = new Model_Daftar_Tipe();
        } elseif ($var == 'akun') {
            $list = new Model_Daftar_Akun();
        } elseif ($var == 'bs') {
            $list = new Model_Daftar_BS();
        } elseif ($var == 'pl') {
            $list = new Model_Daftar_PL();
        } else {
            return $this->respond(['message'=>'no database found']);
        }
        
        return $this->respond($list->find($uuid));
    }

    public function add($var){
        if ($var == 'akun') {
            $list = new Model_Daftar_Akun();
        } elseif ($var == 'tipe') {
            $list = new Model_Daftar_Tipe();
        } elseif ($var == 'bs') {
            $list = new Model_Daftar_BS();
        } elseif ($var == 'pl') {
            $list = new Model_Daftar_PL();
        } else {
            return $this->respond(['message'=>'no database found']);
        }
        
        $list->insert($_POST);
        $response = [
            'status'   => 200,
            'body'     => $_POST,
            'messages' => [
                'success' => 'Ta tambah ji',
            ]
        ];

        return $this->respond($response);
    }

    public function edit($var, $uuid = null){
        if ($var == 'akun') {
            $list = new Model_Daftar_Akun();
        } elseif ($var == 'tipe') {
            $list = new Model_Daftar_Tipe();
        } elseif ($var == 'bs') {
            $list = new Model_Daftar_BS();
        } elseif ($var == 'pl') {
            $list = new Model_Daftar_PL();
        } else {
            return $this->respond(['message'=>'no database found']);
        }


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

        $data['toEdit'] = $list->find($uuid);
        $data['req'] = $_POST;
        
        $list->update($uuid, $_POST);

        $response = [
            'status'   => 200,
            'body'     => $data,
            'messages' => [
                'uuid' => $uuid,
                'post data' => $_POST,
                'var' => $var,
            ]
        ];
        return $this->respond($response);
    }

    public function remove($var, $uuid = null){
        if ($var == 'akun') {
            $list = new Model_Daftar_Akun();
        } elseif ($var == 'tipe') {
            $list = new Model_Daftar_Tipe();
        } elseif ($var == 'bs') {
            $list = new Model_Daftar_BS();
        } elseif ($var == 'pl') {
            $list = new Model_Daftar_PL();
        } else {
            return $this->respond(['message'=>'no database found']);
        }

        $list->delete($uuid);

        return $this->respond(['msg'=> "$uuid deleted"]);
    }

    public function tipe($uuid){
        $list = new Model_Daftar_Tipe();
        return $this->respond($list->find($uuid));
    }

    public function bs($uuid){
        $list = new Model_Daftar_BS();
        return $this->respond($list->find($uuid));
    }

    public function pl($uuid){
        $list = new Model_Daftar_PL();
        return $this->respond($list->find($uuid));
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
                    'Datatable' => 'https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css',
                    'DatatableResponsive' => 'https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css',
                    'adminlte'=>base_url()."/adminlte/css/adminlte.min.css",
                    'myown'=>base_url()."/css/myown.css",
                ],
                'js'  => [
                    'jquery'=>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js",
                    'polyfills'=>"https://polyfill.io/v3/polyfill.min.js?features=Array.prototype.find,Promise,Object.assign",
                    'popper'=>"https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js",
                    'bootstrap'=>"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js",
                    'Datables' => 'https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js',
                    'DatatablesBootstrap' => 'https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js',
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
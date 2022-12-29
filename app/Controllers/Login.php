<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class Login extends ResourceController{
    use RequestTrait;
    use ResponseTrait;
    
    public function view(){
        $tohead['dependencies'] = $this->dependency('head');
        return view('login', $tohead);
    }

    public function post(){
        $response = [
            'status'   => 200,
            'body'     => $_POST,
            'messages' => [
                'success' => 'Ta tambah ji',
            ]
        ];

        return $this->respond($response);
    }

    public function logout(){
        # code...
    }


    
    // -----------------------------------------------------------------
    public function dependency($part=''){
        if ($part == 'head') {
            return [
                'css' => [
                    'Roboto Fonts'=>'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
                    'Material Symbols'=>'https://fonts.googleapis.com/icon?family=Material+Icons',
                    'Font Awesome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                    'adminlte'=>base_url()."/adminlte/css/adminlte.min.css",
                    'login.css'=>base_url()."/css/login.css",
                ],
                'js'  => [
                    'jquery'=>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js",
                    'adminlte'=>base_url().'/adminlte/js/adminlte.min.js',
                    'polyfills'=>"https://polyfill.io/v3/polyfill.min.js?features=Array.prototype.find,Promise,Object.assign",
                    'popper'=>"https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js",
                    'bootstrap'=>"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js",
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
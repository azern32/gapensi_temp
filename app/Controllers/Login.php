<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Login extends ResourceController{
class Login extends BaseController{
    use RequestTrait;
    use ResponseTrait;
    
    public function view(){
        // set variabel $session
        $session = session();

        // Jika berhasil autologin, otomatis masuk ke dashboard
        if ($this->autoLogin($session->get('username'))) {
            return redirect()->to('/dashboard');
        }

        // Terima flashdata dalam session
        $tohead['flash'] = $session->get('flash');

        // Gunakan dependency yang sudah ditetapkan
        $tohead['dependencies'] = $this->dependency('head');

        // load view dengan data dalam $tohead
        return view('login', $tohead);
    }

    public function signin(){
        // set variabel $session
        $session = session();

        // Cek apakah username ada
        // Jika tidak, redirect ke login dengan flashdata
        if (!is_user_exist('a')) {
            $session->setFlashdata('flash', 'Username atau password salah');
            return redirect()->to('/login');
        }


        // Buatkan variabel untuk username dan password
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Cek apakah username dan password sesuai
        // Jika tidak, redirect ke login dengan flashdata        
        if (!authenticate($username,$password)) {
            $session->setFlashdata('flash', 'Username atau password salah');
            return redirect()->to('/login');
        }

        // Set session dengan data dari database user
        $session->set(is_user_exist($username));

        // Hilangkan data tentang password
        $session->remove('password');

        return $this->enter();

        // Testing purpose
        // var_dump($session->get('level'));
        // return view('test');
    }

    public function autoLogin($x){
        // Jika tidak ada username, abaikan fungsi setelahnya
        if (!$x) {return;}

        // Ambil data dari database user untuk lakukan auntentifikasi
        // Lalu redirect ke dashboard
        $result = is_user_exist($x);
        authenticate($result['username'], $result['password']);

        $this->enter();
        // return redirect()->to('/dashboard');
    }

    public function enter(){
        $session = session();

        switch ($session->get('level')) {
            case '1':
                return redirect()->to('/input');
            break;
            
            case '2':
                return redirect()->to('/dashboard');
            break;
            
            case '9':
                return redirect()->to('/dashboard');
            break;
            
            default:
                return redirect()->to('/login');
            break;
        }
    }

    public function logout(){
        // Kosongkan session dan redirect ke login
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
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
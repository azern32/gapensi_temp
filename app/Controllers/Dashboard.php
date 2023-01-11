<?php

namespace App\Controllers;

use App\Models\Model_Jurnal;
use App\Models\Model_Daftar_Akun;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Dashboard extends ResourceController{
class Dashboard extends BaseController{
    use RequestTrait;
    use ResponseTrait;
    protected $helpers = ['form'];
    

    public function view(){
        $session = session();

        // Cek jika ada level user
        // Jika tidak, kembali ke login
        if (!$session->get('level')) {
            return redirect()->to('/login');
        }

        $tohead['list_akun'] = new Model_Daftar_Akun();


        // Simpan dalam variabel dependency dan session
        $tohead['dependencies'] = $this->dependency('head');
        $tohead['session'] = $session->get();
        
        // Simpan dalam variabel dependency dan session        
        return view('layout/layout_dashboard', $tohead);
    }


    public function add(){
        $_POST['bukti_transaksi'] = array();
        // Upload Files ========================
        // Buat pathnya
        $path = WRITEPATH.'uploads/'.$_POST['uuid'];
        // Buat foldernya
        mkdir($path, 0777, true);
        // Untuk setiap file yang diupload, simpan satu-satu
        foreach ($_FILES["bukti_transaksi"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["bukti_transaksi"]["tmp_name"][$key];
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["bukti_transaksi"]["name"][$key]);
                array_push($_POST['bukti_transaksi'], $name);
                move_uploaded_file($tmp_name, "$path/$name");
            }
        }

        // Hitung akun ========================
        $this->hitungAkun($_POST['akun_kredit'], $_POST['akun_debet'], $_POST['nilai']);
        $this->hitungSaldo($_POST['akun_kredit']);
        $this->hitungSaldo($_POST['akun_debet']);

        // Masukkan data ke database ========================
        // Panggil databasenya
        $jurnal = new Model_Jurnal();
        // Ubah array ke string
        $_POST['bukti_transaksi'] = json_encode($_POST['bukti_transaksi']);
        // Simpan ke database
        $jurnal->insert($_POST);
        

        // laporan
        return $this->respond(['path' => $path, 'post'=>$_POST, ]);
    }

    public function list(){
        
    }




    
    // -----------------------------------------------------------------

    public function hitungAkun($uuid_kredit, $uuid_debet, $nominal = 0, $flip = false){
        $akun = new Model_Daftar_Akun();
        $sumber = $akun->where('uuid', $uuid_kredit)->first();
        $tujuan = $akun->where('uuid', $uuid_debet)->first();

        if ($flip) { $nominal *= -1; }

        $akun->update($sumber, ['kredit' => $sumber['kredit'] + $nominal ]);
        $akun->update($tujuan, ['debit' => $tujuan['debit'] + $nominal ]);
    }

    public function hitungSaldo($uuid_akun){
        $akun = new Model_Daftar_Akun();
        $rekening = $akun->where('uuid', $uuid_akun)->first();

        $akun->update($uuid_akun, 
            ['saldo' => $rekening['debit'] - $rekening['kredit']]
        );
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
                    'adminlte'=>base_url()."/adminlte/css/adminlte.min.css" ,
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
                    'file input'=>base_url().'/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
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

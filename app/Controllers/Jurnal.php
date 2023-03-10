<?php

namespace App\Controllers;

use App\Models\Model_Jurnal;
use App\Models\Model_Daftar_Akun;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Jurnal extends ResourceController{
class Jurnal extends BaseController{
    use RequestTrait;
    use ResponseTrait;
    protected $helpers = ['form', 'auth', 'account', 'filesystem'];

    

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


        $db      = \Config\Database::connect();
        $builder = $db->table('jurnal');
        $query   = $builder->orderBy('timestamp', 'DESC')->get();
        $lognormal = $query->getResult();
        $tohead['list2'] = $lognormal;

        $tohead['list'] = $this->list();

        
        // Simpan dalam variabel dependency dan session        
        return view('layout/layout_jurnal', $tohead);
    }


    
    public function list(){
        // Ambil data semua dari jurnal
        $db      = \Config\Database::connect();
        $builder = $db->table('jurnal');
        $query   = $builder->orderBy('timestamp', 'DESC')->get();
        $lognormal = $query->getResult();

        $logbaru = array();

        foreach ($lognormal as $key => $value) {
            array_push($logbaru, (object) 
                [
                    'uuid'=>$value->uuid,
                    'referensi'=>$value->referensi,
                    'timestamp'=>$value->timestamp,
                    'tanggal'=>$value->tanggal,
                    'akun'=>$value->akun_debet,
                    'keterangan'=>$value->keterangan,
                    'nominal'=>$value->nilai,
                    'tipe' => 'Debet',
                    'nominal_debet'=>$value->nilai,
                    'nominal_kredit'=>'-',
                ], (object) 
                [
                    'uuid'=>$value->uuid,
                    'referensi'=>$value->referensi,
                    'timestamp'=>$value->timestamp,
                    'tanggal'=>$value->tanggal,
                    'akun'=>$value->akun_kredit,
                    'keterangan'=>$value->keterangan,
                    'nominal'=>$value->nilai,
                    'tipe' => 'Kredit',
                    'nominal_debet'=>'-',
                    'nominal_kredit'=>$value->nilai,
                ],
            );
        }

        return $logbaru;
    }

    public function get($uuid){
        $akun = new Model_Jurnal();
        $data = $akun->find($uuid);
        return $this->respond($data);
    }

    
    public function latest($timestamp){
        $akun = new Model_Jurnal();
        return $this->respond($akun->where('timestamp', $timestamp)->first());
    }


    
  
    // -----------------------------------------------------------------

    public function hitungAkun($uuid_kredit, $uuid_debet, $nominal = 0, $remove = false){
        $akun = new Model_Daftar_Akun();
        $sumber = $akun->where('uuid', $uuid_kredit)->first();
        $tujuan = $akun->where('uuid', $uuid_debet)->first();

        if ($remove) { $nominal *= -1; }

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
                    'DatatableButtons' => 'https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css',
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
                    'DatatabeButtons'=>'https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js',
                    'jszip'=>'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
                    'DatatabeButtonsHTML5'=>'https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js',
                    'DatatabeButtonsPrint'=>'https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js',
                    'pdfmake1'=>'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
                    'pdfmake2'=>'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
                    'adminlte' => base_url().'/adminlte/js/adminlte.min.js',
                    'myown' => base_url()."/js/myown.js",
                ]
            ];
        } 
        
        return [
                // 'chartJS'=>"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js",
                'myown' => base_url()."/js/myown.js",
        ];
    

    }
}
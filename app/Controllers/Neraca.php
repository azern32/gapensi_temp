<?php

namespace App\Controllers;

use App\Models\Model_Jurnal;
use App\Models\Model_Daftar_Akun;
use App\Models\Model_Daftar_Tipe;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

helper('auth');
// class Neraca extends ResourceController{
class Neraca extends BaseController{
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
        return view('layout/layout_neraca', $tohead);
    }


    
    public function list(){
        $akun = new Model_Jurnal();
        $data = $akun->findAll();
        return $this->respond($data);
    }

    public function listSpesifik($bulan, $tanggal){
        $akun = new Model_Jurnal();
        $data = $akun->findAll();
        return $this->respond($data);
    }

    public function labarugi(){
        /*
        Tarik jurnal
        Buat variabel bulan
        Susun ulang jurnal ke dalam variabel bulan
        Tiap bulan, cek masing-masing akun
            masing-masing akun hitung debit dan kreditnya sendiri-sendiri

        
        */ 
        $jurnal = new Model_Jurnal();
        $akun = new Model_Daftar_Akun();
        $tipe = new Model_Daftar_Tipe();
        $dataJurnal = $jurnal->findAll();
        $dataAkun = $akun->findAll();
        $dataTipe = $tipe->findAll();
        $thisYear = date('Y');
        $thisTanggal = 21;


        $bulanan = [[],[],[],[],[],[],[],[],[],[],[],[]];
        for ($i=0; $i < count($bulanan); $i++) { 
            foreach ($dataJurnal as $index => $jurnal) {
                $temp = $this->filterJurnal($jurnal, $thisYear, $i + 1, $thisTanggal); // pake fungsi filterJurnal yang dibikin di bawah, biar nda blepotan
                if (!isset($temp)) {
                    continue;
                }
                
                $debet = $temp['akun_debet'];
                $kredit = $temp['akun_kredit'];
                $nilai = (int)$temp['nilai'];

                if (!isset($bulanan[$i][$debet])) {
                    $bulanan[$i][$debet] = ['debet'=>0, 'kredit'=>0];
                }
                
                if (!isset($bulanan[$i][$kredit])) {
                    $bulanan[$i][$kredit] = ['debet'=>0, 'kredit'=>0];
                }

                $bulanan[$i][$debet]['debet'] += $nilai;
                $bulanan[$i][$kredit]['kredit'] += $nilai;
            }
        }

        print_r($bulanan);



        // return $this->respond($data);

    }





    // -----------------------------------------------------------------

    public function checkParent(array $tipe, array $akun){
        return $akun['tipe_akun'] == $tipe['uuid'] ? true : false;
    }

    public function filterJurnal($jurnal, $tahun = 0, $bulan = 0, $tanggal = 0 ){
        $date=strtotime($jurnal['tanggal']);
        $dateOldest = strtotime("$tahun-".($bulan - 1)."-$tanggal");
        $dateNewest = strtotime("$tahun-$bulan-$tanggal");

        if ($date >= $dateNewest || $date < $dateOldest) {return NULL;}
        return $jurnal;
    }

    // fungsi ini di loop nanti di dalam bulanan
    public function extrakKredit(string $uuid_akun, array $jurnal){
        $res = [ $uuid_akun => [
            $jurnal['akun_kredit'] => $jurnal['nilai']
        ]];
        return $res;
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
                    'adminlte'=>base_url()."/adminlte/css/adminlte.min.css",
                    'myown'=>base_url()."/css/myown.css",
                ],
                'js'  => [
                    'jquery' => "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js",
                    'polyfills' => "https://polyfill.io/v3/polyfill.min.js?features=Array.prototype.find,Promise,Object.assign",
                    'popper' => "https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js",
                    'bootstrap' => "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js",
                    'DatatablesBootstrap' => 'https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js', 
                    'DatatablesResponsive' => 'https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js', 
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
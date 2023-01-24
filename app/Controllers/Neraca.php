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
        $arranged = $this->rearrangeLabaRugi();

        foreach ($arranged as $uuid_tipe => $akun) {
            // $uuid_tipe itu string uuid tipe
            // $akun itu array string uuid akun

            foreach ($akun as $key => $uuid_akun) {
                // $key itu int index
                // $uuid_akun itu string uuid akun

                $arranged[$uuid_tipe] = [$uuid_akun => $bulanan];

                for ($i=0; $i < count($bulanan); $i++) {

                    if (empty($arranged[$uuid_tipe][$uuid_akun][$i])) {
                        $arranged[$uuid_tipe][$uuid_akun][$i]['debet'] = 0;
                        $arranged[$uuid_tipe][$uuid_akun][$i]['kredit'] = 0;
                    }

                    foreach ($dataJurnal as $keyJurnal => $jurnal) {
                        $temp = $this->filterJurnal($jurnal, $thisYear, $i + 1, $thisTanggal); // pake fungsi filterJurnal yang dibikin di bawah, biar nda blepotan

                        if (!isset($temp)) {
                            continue;
                        }
                        

                        if ($uuid_akun == $temp['akun_debet']) {
                            $arranged[$uuid_tipe][$uuid_akun][$i]['debet'] += $temp['nilai'];
                        }

                        if ($uuid_akun == $temp['akun_kredit']) {
                            $arranged[$uuid_tipe][$uuid_akun][$i]['kredit'] += $temp['nilai'];
                        }

                        // cek uuid debet dan kredit terhadap uuid_akun
                        // kalo sama, hitung




                        // array_push($arranged[$uuid_tipe][$uuid_akun][$i], $temp);
                        
                        // $arranged[$uuid_tipe][$uuid_akun][$i] = $temp;
                        // var_dump($temp);
                        // var_dump($keyJurnal);
                    }
                }

                // foreach ($dataJurnal as $indexJurnal => $jurnal) {
                //     for ($i=0; $i < count($arranged[$uuid_tipe][$uuid_akun]); $i++) {
                //         $temp = $this->filterJurnal($jurnal, $thisYear, $i + 1, $thisTanggal); // pake fungsi filterJurnal yang dibikin di bawah, biar nda blepotan
                //         // var_dump($temp);

                //         $arranged[$uuid_tipe][$uuid_akun][$i] = ['debet'=>0, 'kredit'=>0];
                        
                //         if (!isset($temp)) {
                //             continue;
                //         }

                //         $arranged[$uuid_tipe][$uuid_akun][$i]['debet'] += (int)$temp['nilai'];
                //         $arranged[$uuid_tipe][$uuid_akun][$i]['kredit'] += (int)$temp['nilai'];
                //     }
                // }

            }
        }
        
        // var_dump($arranged);





        // for ($i=0; $i < count($bulanan); $i++) { 
        //     foreach ($dataJurnal as $index => $jurnal) {
        //         $temp = $this->filterJurnal($jurnal, $thisYear, $i + 1, $thisTanggal); // pake fungsi filterJurnal yang dibikin di bawah, biar nda blepotan
        //         if (!isset($temp)) {
        //             continue;
        //         }
                
        //         $debet = $temp['akun_debet'];
        //         $kredit = $temp['akun_kredit'];
        //         $nilai = (int)$temp['nilai'];

        //         if (!isset($bulanan[$i][$debet])) {
        //             $bulanan[$i][$debet] = ['debet'=>0, 'kredit'=>0];
        //         }
                
        //         if (!isset($bulanan[$i][$kredit])) {
        //             $bulanan[$i][$kredit] = ['debet'=>0, 'kredit'=>0];
        //         }

        //         $bulanan[$i][$debet]['debet'] += $nilai;
        //         $bulanan[$i][$kredit]['kredit'] += $nilai;
        //     }
        // }



        return $this->respond($arranged);
    }





    // -----------------------------------------------------------------

    public function checkParent(array $tipe, array $akun){
        return $akun['tipe_akun'] == $tipe['uuid'] ? true : false;
    }

    public function filterJurnal($jurnal, $tahun = 0, $bulan = 0, $tanggal = 0 ){
        $date=strtotime($jurnal['tanggal']);
        $dateOldest = strtotime("$tahun-".($bulan - 1)."-$tanggal");
        $dateNewest = strtotime("$tahun-$bulan-$tanggal");

        if ($date >= $dateNewest || $date < $dateOldest) {
            return NULL;
        }

        return $jurnal;
    }


    public function rearrangeLabaRugi(){
        if (!isset($dataAkun)) {
            $akun = new Model_Daftar_Akun();
            $dataAkun = $akun->findAll();
        }

        if (!isset($dataTipe)) {
            $tipe = new Model_Daftar_Tipe();
            $dataTipe = $tipe->findAll();
        }

        $arranged=[];

        foreach ($dataTipe as $key => $value) {
            if (!isset($arranged[$value['uuid']])) {
                $arranged[$value['uuid']] = [];
            }
        }

        foreach ($dataAkun as $key => $value) {
            if (array_key_exists($value['tipe_akun'], $arranged)) {
                $tipe_uuid = $value['tipe_akun'];
                array_push($arranged[$tipe_uuid], $value['uuid']);
            }
        }
    
        return $arranged;
    }

    public function finalArrayLabaRugi(array $bulanan, array $arrangedArray){
        $res = [];
        foreach ($arrangedArray as $key => $value) {
            for ($i=0; $i < count($value); $i++) {

                for ($j=0; $j < count($bulanan); $j++) { 
                    foreach ($bulanan[$j] as $bulan => $isi) {
                        if ($value[$i] == $bulan) {
                            $res[$key][$i] = $isi;
                        } else {
                            $res[$key][$i] = 0;
                        }
                    }
                }

            }
        }

        return $res;
    }



    
    // -----------------------------------------------------------------
    
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
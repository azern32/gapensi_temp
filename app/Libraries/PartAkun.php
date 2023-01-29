<?php namespace App\Libraries;

// Membuat widget untuk mereplicate potongan kode
// Tutorial mengikuti https://www.petanikode.com/codeigniter4-view-cell/
class PartAkun{
    public function akun(array $arg = null){
        return view('part/akun', $arg);
    }

    public function tipe(array $arg = null){
        return view('part/tipe', $arg);
    }

    public function bs(array $arg = null){
        return view('part/bs', $arg);
    }

    public function pl(array $arg = null){
        return view('part/pl', $arg);
    }
}
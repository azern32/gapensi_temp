<?php namespace App\Libraries;

// Membuat widget untuk mereplicate potongan kode
// Tutorial mengikuti https://www.petanikode.com/codeigniter4-view-cell/
class Widget
{
    // Menampilkan potongan kode view widget/cardRKA
    // bisa menerima argument array
    public function cardRKA(array $arg=null){
        // Cek $arg['table_name]
        // Jika ['table_name'] sama dengan nama tabel RKA Tahunan, text judul menjadi RKA Tahunan
        // Jika ['table_name'] sama dengan nama tabel RKA Jangka Panjang, text judul menjadi RKA Jangka Panjang
        // Tambahkan result sebagai $arg['RKA_type']
        if ($arg['table_name'] == 'rka_tahunan') {
            $arg['RKA_type'] = 'RKA Tahunan';
        } elseif ($arg['table_name'] == 'rka_jangka_panjang') {
            $arg['RKA_type'] = 'RKA Jangka Panjang';
        }

        return view('widget/cardRKA', $arg);
    }


    public function cardArusKas(array $arg = null){
        return view('widget/cardArusKas', $arg);
    }

    public function cardLogJurnal(array $arg = null){
        return view('widget/cardLogJurnal', $arg);
    }
}
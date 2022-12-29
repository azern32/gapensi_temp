<?php

namespace App\Controllers;

class Home extends BaseController {


    public function index() {

        $tohead['dependencies'] = $this->dependency('head');
        $tobody['dependencies'] = $this->dependency();
        // var_dump($headDependency);

        return view('head', $tohead)
        .view('navbar') // no need for dependency here
        .view('dashboard', $tobody)
        .view('end');
    }
    

    public function wah() {
        echo base_url();
    }








    // -----------------------------------------------------------------    
    public function dependency($part=''){
        if ($part == 'head') {
            return [
                'css' => [
                    'Roboto Fonts'=>'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
                    'Material Symbols'=>'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
                    'myown'=>base_url()."/css/myown.css",
                ],
                'js'  => [
                    'jquery'=>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
                ]
            ];
        } 
        
        return [
                'chartJS'=>"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js",
        ];
    

    }
}

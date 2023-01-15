<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
// $routes->setDefaultMethod('index');
$routes->setDefaultMethod('view');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');


$routes->group('login', static function ($routes){
    $routes->post('/signin', 'Login::signin'); //login
    $routes->get('/', 'Login::view'); //view halaman login
    $routes->get('/logout', 'Login::logout'); //logout
});

$routes->group('dashboard', static function ($routes){
    $routes->post('/rka_new/(:alpha)', 'Dashboard::rka_new/$1'); //tambah RKA
    $routes->get('/rka/(:alpha)/(:uuid)', 'Dashboard::rka/$1/$2'); //ambil detail RKA spesifik
    $routes->get('/rka_list/(:alpha)', 'Dashboard::rka/$1'); //ambil daftar RKA

    $routes->post('/add', 'Dashboard::add'); //tambah catatan
    $routes->post('/edit/(:uuid)', 'Dashboard::edit/$1'); //edit catatan
    $routes->get('/remove/(:uuid)', 'Dashboard::remove/$1'); //hapus catatan
    $routes->get('/list', 'Dashboard::list'); //ambil seluruh catatan
    $routes->get('/listlatest/(:num)', 'Dashboard::listlatest/$1'); //ambil catatan terakhir
    $routes->get('/', 'Dashboard::view'); //view halaman
});

$routes->group('jurnal', static function ($routes){
    $routes->get('/', 'Jurnal::view');
    $routes->get('/list/(:alpha)', 'Jurnal::list/$1');
    $routes->get('/add/(:alpha)', 'Jurnal::add/$1');
    $routes->post('/remove/(:alpha)', 'Jurnal::remove/$1');
});

$routes->group('neraca', static function ($routes){
    $routes->get('/', 'Neraca::view');
});

$routes->group('rekening', static function ($routes){
    $routes->post('/add/(:alpha)', 'Rekening::add/$1');
    $routes->post('/edit/(:alpha)/(:uuid)', 'Rekening::edit/$1/$2');
    $routes->get('/', 'Rekening::view');
    $routes->get('/list/(:alpha)', 'Rekening::list/$1');
});

$routes->group('tipe', static function ($routes){
    $routes->get('/list', 'Tipe::list');
    $routes->post('/add', 'Tipe::add');
    $routes->post('/edit/(:uuid)', 'Tipe::edit/$1');
    $routes->post('/remove/(:uuid)', 'Tipe::remove/$1');
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

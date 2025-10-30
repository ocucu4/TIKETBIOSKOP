<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// ROUTES UTAMA (HALAMAN HOME)
$routes->get('/', 'Home::index');


$routes->group('bioskop', function($routes){
    $routes->get('/', 'Bioskop::index');
    $routes->add('tambah', 'Bioskop::tambah');
    $routes->add('ubah', 'Bioskop::ubah');
    $routes->get('hapus/(:any)', 'Bioskop::hapus/$1');
});

$routes->group('gendre', function($routes){
    $routes->get('/', 'Gendre::index');
    $routes->add('tambah', 'Gendre::tambah');
    $routes->add('ubah', 'Gendre::ubah');
    $routes->get('hapus/(:any)', 'Gendre::hapus/$1');
});


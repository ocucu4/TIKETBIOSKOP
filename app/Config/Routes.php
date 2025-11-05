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

$routes->group('genre', function($routes){
    $routes->get('/', 'Genre::index');
    $routes->add('tambah', 'Genre::tambah');
    $routes->add('ubah', 'Genre::ubah');
    $routes->get('hapus/(:any)', 'Genre::hapus/$1');
});


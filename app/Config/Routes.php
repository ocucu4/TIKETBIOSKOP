<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('bioskop', function($routes){
    $routes->get('/', 'Bioskop::index');
    $routes->get('tambah', 'Bioskop::tambah');
    $routes->post('simpan', 'Bioskop::simpan');
    $routes->get('ubah/(:num)', 'Bioskop::ubah/$1');
    $routes->post('update/(:num)', 'Bioskop::update/$1');
    $routes->get('hapus/(:num)', 'Bioskop::hapus/$1');
});


$routes->group('genre', function($routes){
    $routes->get('/', 'Genre::index');
    $routes->add('tambah', 'Genre::tambah');
    $routes->add('ubah', 'Genre::ubah');
    $routes->get('hapus/(:any)', 'Genre::hapus/$1');
    $routes->post('simpan', 'Genre::simpan');
});


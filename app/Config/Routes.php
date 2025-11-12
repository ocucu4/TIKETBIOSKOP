<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/', 'home::Login');

    $routes->get('bioskop', 'Bioskop::index');
    $routes->get('bioskop/tambah', 'Bioskop::tambah');
    $routes->post('bioskop/simpan', 'Bioskop::add');
    $routes->get('bioskop/ubah', 'Bioskop::ubah');
    $routes->post('bioskop/update', 'Bioskop::update');
    $routes->get('bioskop/delete/(:num)', 'Bioskop::delete/$1');

$routes->group('genre', function($routes){
    $routes->get('/', 'Genre::index');
    $routes->add('tambah', 'Genre::tambah');
    $routes->add('ubah', 'Genre::ubah');
    $routes->get('hapus/(:any)', 'Genre::hapus/$1');
    $routes->post('simpan', 'Genre::simpan');
});

$routes->group('detailorder', function($routes){
    $routes->get('/', 'DetailOrder::index');        
    $routes->get('tambah', 'DetailOrder::tambah');  
    $routes->post('add', 'DetailOrder::add');
    $routes->get('ubah', 'DetailOrder::ubah');    
    $routes->post('update', 'DetailOrder::update');
    $routes->get('delete/(:num)', 'DetailOrder::delete/$1');
});


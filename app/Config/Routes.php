<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ROUTES UNTUK HALAMAN FILM (ADMIN)
$routes->get('/film', 'Film::index');
$routes->get('/film/create', 'Film::create');
$routes->post('/film/store', 'Film::store');
$routes->get('/film/edit/(:num)', 'Film::edit/$1');
$routes->post('/film/update/(:num)', 'Film::update/$1');
$routes->get('/film/delete/(:num)', 'Film::delete/$1');

// ROUTES UNTUK PEMESANAN TIKET (USER)
$routes->get('/order/create/(:num)', 'Order::create/$1');
$routes->post('/order/store', 'Order::store');
$routes->get('/order/success', 'Order::success');

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


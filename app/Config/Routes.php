<?php

use App\Controllers\Bioskop;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'home::index');

$routes->get('dashboard', 'Dashboard::index');

$routes->group('bioskop', function($routes){
    $routes->get('/', 'Bioskop::index');
    $routes->get('tambah', 'Bioskop::tambah');
    $routes->post('simpan', 'Bioskop::add');
    $routes->get('ubah/(:num)', 'Bioskop::ubah/$1');
    $routes->post('update/(:num)', 'Bioskop::update/$1');
    $routes->get('hapus/(:num)', 'Bioskop::delete/$1');
    $routes->get('delete/(:num)', 'Bioskop::delete/$1');
});

$routes->group('film', function($routes){
    $routes->get('/', 'Film::index');
    $routes->get('tambah', 'Film::tambah');
    $routes->post('simpan', 'Film::add');
    $routes->get('ubah/(:num)', 'Film::ubah/$1');
    $routes->post('update/(:num)', 'Film::update/$1');
    $routes->get('hapus/(:any)', 'Film::delete/$1');
    $routes->get('delete/(:num)', 'Film::delete/$1');
});

$routes->group('genre', function($routes) {
    $routes->get('/', 'Genre::index');
    $routes->get('tambah', 'Genre::tambah');
    $routes->post('simpan', 'Genre::simpan');
    $routes->get('ubah/(:num)', 'Genre::ubah/$1');
    $routes->post('update/(:num)', 'Genre::update/$1');
    $routes->get('hapus/(:num)', 'Genre::hapus/$1');
});

$routes->group('room', function($routes){
    $routes->get('/', 'Room::index');
    $routes->get('tambah', 'Room::tambah');
    $routes->post('add', 'Room::add');
    $routes->get('ubah/(:num)', 'Room::ubah/$1');  
    $routes->post('update/(:num)', 'Room::update/$1');
    $routes->get('hapus/(:num)', 'Room::hapus/$1');
    $routes->get('delete/(:num)', 'Room::hapus/$1');
});

$routes->group('kursi', function($routes){
    $routes->get('/', 'Kursi::index');
    $routes->get('tambah', 'Kursi::tambah');
    $routes->post('add', 'Kursi::add');
    $routes->get('ubah/(:num)', 'Kursi::ubah/$1');
    $routes->post('update/(:num)', 'Kursi::update/$1');
    $routes->get('hapus/(:num)', 'Kursi::delete/$1');
    $routes->get('delete/(:num)', 'Kursi::delete/$1');
});

$routes->group('order', function($routes){
    $routes->get('/', 'Order::index');
    $routes->get('tambah', 'Order::tambah');
    $routes->post('add', 'Order::add');
    $routes->get('ubah/(:num)', 'Order::ubah/$1');
    $routes->post('update/(:num)', 'Order::update/$1');
    $routes->get('hapus/(:num)', 'Order::delete/$1');
});

$routes->group('detailorder', function($routes){
    $routes->get('/', 'DetailOrder::index');
    $routes->get('tambah', 'DetailOrder::tambah');
    $routes->post('add', 'DetailOrder::add');
    $routes->get('ubah/(:num)', 'DetailOrder::ubah/$1');
    $routes->post('update/(:num)', 'DetailOrder::update/$1');
    $routes->get('delete/(:num)', 'DetailOrder::delete/$1');
});

$routes->group('pembayaran', function($routes){
    $routes->get('/', 'Pembayaran::index');
    $routes->get('tambah', 'Pembayaran::tambah');
    $routes->post('add', 'Pembayaran::add');
    $routes->get('ubah/(:num)', 'Pembayaran::ubah/$1');
    $routes->post('update', 'Pembayaran::update');
    $routes->get('hapus/(:num)', 'Pembayaran::hapus/$1');
});


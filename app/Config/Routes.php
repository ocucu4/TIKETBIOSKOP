<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// LOGIN
$routes->get('login', 'UserAuth::loginForm');
$routes->post('auth/login', 'UserAuth::login');
$routes->get('logout', 'UserAuth::logout');

// KASIR
$routes->group('kasir', ['filter' => 'kasirAuth'], function ($routes) {
    $routes->get('dashboard', 'Kasir\Dashboard::index');
    $routes->get('transaksi', 'Kasir\Transaksi::index');
});

// ADMIN
$routes->get('dashboard', 'Dashboard::index');

    // BIOSKOP
    $routes->group('bioskop', function($routes) {
        $routes->get('/', 'Bioskop::index');
        $routes->post('simpan', 'Bioskop::simpan');
        $routes->post('update/(:num)', 'Bioskop::update/$1');
        $routes->get('hapus/(:num)', 'Bioskop::hapus/$1');
    });

    // FILM
    $routes->group('film', function($routes) {
        $routes->get('/', 'Film::index');          
        $routes->post('add', 'Film::add');          
        $routes->post('update/(:num)', 'Film::update/$1');
        $routes->get('delete/(:num)', 'Film::delete/$1');
    });

    // GENRE
    $routes->group('genre', function($routes){
        $routes->get('/', 'Genre::index');
        $routes->get('tambah', 'Genre::tambah');
        $routes->post('simpan', 'Genre::simpan');
        $routes->post('add', 'Genre::add');
        $routes->get('ubah/(:num)', 'Genre::ubah/$1');
        $routes->post('update/(:num)', 'Genre::update/$1');
        $routes->get('hapus/(:num)', 'Genre::hapus/$1');
        $routes->get('delete/(:num)', 'Genre::delete/$1');
    });

    // ROOM
    $routes->get('room', 'Room::index');
    $routes->post('room/add', 'Room::add');
    $routes->get('room/delete/(:num)', 'Room::delete/$1');

    // JADWAL TAYANG
    $routes->group('jadwaltayang', function($routes){
        $routes->get('/', 'JadwalTayang::index');
        $routes->post('create', 'JadwalTayang::create');
        $routes->post('update/(:num)', 'JadwalTayang::update/$1');
        $routes->get('delete/(:num)', 'JadwalTayang::delete/$1');
    });

    // KURSI
        $routes->get('kursi', 'Kursi::index');
        $routes->post('kursi/update/(:num)', 'Kursi::update/$1');

    // KURSI JADWAL STATUS
    $routes->group('kursijadwalstatus', function($routes){
        $routes->get('/', 'KursiJadwalStatus::index');
        $routes->post('update', 'KursiJadwalStatus::update');
    });

    // ORDER
    $routes->group('order', function($routes){
        $routes->get('/', 'Order::index');
        $routes->post('add', 'Order::add');
        $routes->post('update/(:num)', 'Order::update/$1');
        $routes->get('delete/(:num)', 'Order::delete/$1');
    });

    // DETAIL ORDER
    $routes->group('detailorder', function($routes){
        $routes->get('order/(:num)', 'DetailOrder::index/$1');
        $routes->post('add', 'DetailOrder::add');
        $routes->get('delete/(:num)', 'DetailOrder::delete/$1');
    });

    // PEMBAYARAN
    $routes->group('pembayaran', function($routes){
        $routes->get('/', 'Pembayaran::index');
        $routes->get('tambah', 'Pembayaran::tambah');
        $routes->post('add', 'Pembayaran::add');
        $routes->get('ubah/(:num)', 'Pembayaran::ubah/$1');
        $routes->post('update', 'Pembayaran::update');
        $routes->get('hapus/(:num)', 'Pembayaran::hapus/$1');
    });


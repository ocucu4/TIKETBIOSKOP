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
$routes->group('', ['filter' => 'adminAuth'], function($routes){

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
        $routes->post('simpan', 'Film::simpan');
        $routes->post('update/(:num)', 'Film::update/$1');
        $routes->get('hapus/(:num)', 'Film::delete/$1');
    });

    // GENRE
    $routes->group('genre', function($routes){
        $routes->get('/', 'Genre::index');
        $routes->get('tambah', 'Genre::tambah');
        $routes->post('simpan', 'Genre::simpan');
        $routes->get('ubah/(:num)', 'Genre::ubah/$1');
        $routes->post('update/(:num)', 'Genre::update/$1');
        $routes->get('hapus/(:num)', 'Genre::hapus/$1');
    });

    // ROOM
    $routes->group('room', function($routes){
        $routes->get('/', 'Room::index');
        $routes->get('tambah', 'Room::tambah');
        $routes->post('add', 'Room::add');
        $routes->get('ubah/(:num)', 'Room::ubah/$1');
        $routes->post('update/(:num)', 'Room::update/$1');
        $routes->get('hapus/(:num)', 'Room::hapus/$1');
    });

    // JADWAL TAYANG
    $routes->group('jadwaltayang', function($routes){
        $routes->get('/', 'JadwalTayang::index');
        $routes->post('simpan', 'JadwalTayang::simpan');
        $routes->post('update/(:num)', 'JadwalTayang::update/$1');
        $routes->get('hapus/(:num)', 'JadwalTayang::delete/$1');
    });

    // KURSI
    $routes->group('kursi', function($routes) {
        $routes->get('/', 'Kursi::index');
        $routes->post('add', 'Kursi::add');
        $routes->post('update/(:num)', 'Kursi::update/$1');
        $routes->get('hapus/(:num)', 'Kursi::hapus/$1');
    });

    // KURSI JADWAL STATUS
    $routes->group('kursijadwalstatus', function($routes){
        $routes->get('/', 'KursiJadwalStatus::index');
        $routes->post('simpan', 'KursiJadwalStatus::simpan');
        $routes->post('update/(:num)', 'KursiJadwalStatus::update/$1');
        $routes->get('hapus/(:num)', 'KursiJadwalStatus::hapus/$1');
    });

    // ORDER
    $routes->group('order', function($routes){
        $routes->get('/', 'Order::index');
        $routes->get('tambah', 'Order::tambah');
        $routes->post('add', 'Order::add');
        $routes->get('ubah/(:num)', 'Order::ubah/$1');
        $routes->post('update/(:num)', 'Order::update/$1');
        $routes->get('hapus/(:num)', 'Order::delete/$1');
    });

    // DETAIL ORDER
    $routes->group('detailorder', function($routes){
        $routes->get('/', 'DetailOrder::index');
        $routes->get('tambah', 'DetailOrder::tambah');
        $routes->post('add', 'DetailOrder::add');
        $routes->get('ubah/(:num)', 'DetailOrder::ubah/$1');
        $routes->post('update/(:num)', 'DetailOrder::update/$1');
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

});

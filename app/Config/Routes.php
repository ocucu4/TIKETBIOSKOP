<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'UserAuth::loginForm');

// LOGIN
$routes->get('login', 'UserAuth::loginForm');
$routes->post('auth/login', 'UserAuth::login');
$routes->get('logout', 'UserAuth::logout');

// =======================
// KASIR
$routes->group('kasir', function ($routes) {
    $routes->get('dashboard', 'Kasir::dashboard');
    $routes->get('pilih-film', 'Kasir::pilihFilm');
    $routes->get('pilih-kursi/(:num)', 'Kasir::pilihKursi/$1');
    $routes->post('konfirmasi-pembayaran', 'Kasir::konfirmasiPembayaran');
    $routes->post('proses-pembayaran', 'Kasir::prosesPembayaran');
    $routes->get('verifikasi', 'Kasir::verifikasiPembayaran');
    $routes->post('verifikasi/berhasil', 'Kasir::pembayaranBerhasil');
    $routes->post('verifikasi/batal', 'Kasir::pembayaranBatal');
    $routes->get('sukses/(:num)', 'Kasir::transaksiBerhasil/$1');
    $routes->get('cetak-tiket/(:num)', 'Kasir::cetakTiket/$1');
    $routes->get('riwayat', 'Kasir::riwayat');
});

// ADMIN
$routes->get('dashboard', 'Dashboard::index');

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
        $routes->post('add', 'Genre::add');
        $routes->post('update/(:num)', 'Genre::update/$1');
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
        $routes->get('(:num)', 'KursiJadwalStatus::index/$1');
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
        $routes->post('add', 'Pembayaran::add');
        $routes->post('update/(:num)', 'Pembayaran::update/$1');
        $routes->get('delete/(:num)', 'Pembayaran::delete/$1');
    });

    // LAPORAN
    $routes->group('laporan', function($routes){
        $routes->get('/', 'Laporan::index');
    });

    

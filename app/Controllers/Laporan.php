<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = $this->db->table('order o')
            ->select('
                o.id_order,
                o.tanggal_order,
                o.status_order,
                f.judul_film,
                r.nama_room,
                COUNT(d.id_detail) AS jumlah_kursi,
                COALESCE(SUM(d.harga), 0) AS total_bayar,
                p.metode_bayar
            ')
            ->join('jadwal_tayang jt', 'jt.id_tayang = o.id_tayang')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
            ->join('detail_order d', 'd.id_order = o.id_order', 'left')
            ->join('pembayaran p', 'p.id_order = o.id_order', 'left')
            ->groupBy('o.id_order')
            ->orderBy('o.tanggal_order', 'DESC')
            ->get()
            ->getResult();

        return view('laporan/index', [
            'data' => $data
        ]);
    }
}

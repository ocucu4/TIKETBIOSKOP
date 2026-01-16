<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $filmModel = new FilmModel();
        $userModel = new UserModel();

        $totalFilm  = $filmModel->countAll();
        $totalKasir = $userModel->where('role', 'kasir')->countAllResults();

        $tiketTerjual = $db->table('detail_order d')
            ->join('order o', 'o.id_order = d.id_order')
            ->where('o.status_order', 'lunas')
            ->countAllResults();

        $topFilm = $db->table('detail_order d')
            ->select('f.judul_film, COUNT(d.id_detail) AS total')
            ->join('order o', 'o.id_order = d.id_order')
            ->join('jadwal_tayang j', 'j.id_tayang = o.id_tayang')
            ->join('film f', 'f.id_film = j.id_film')
            ->where('o.status_order', 'lunas')
            ->groupBy('f.id_film')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $rows = $db->table('detail_order d')
            ->select('MONTH(o.tanggal_order) AS bulan, COUNT(d.id_detail) AS total')
            ->join('order o', 'o.id_order = d.id_order')
            ->where('o.status_order', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->getResultArray();

        $grafik = array_fill(1, 12, 0);
        foreach ($rows as $r) {
            $grafik[(int)$r['bulan']] = (int)$r['total'];
        }

        $tooltipRows = $db->table('detail_order d')
            ->select('
                MONTH(o.tanggal_order) AS bulan,
                f.judul_film,
                COUNT(d.id_detail) AS total
            ')
            ->join('order o', 'o.id_order = d.id_order')
            ->join('jadwal_tayang j', 'j.id_tayang = o.id_tayang')
            ->join('film f', 'f.id_film = j.id_film')
            ->where('o.status_order', 'lunas')
            ->groupBy('bulan, f.id_film')
            ->get()
            ->getResultArray();

        $tooltipData = [];
        foreach ($tooltipRows as $r) {
            $bulan = (int)$r['bulan'];
            $tooltipData[$bulan][] = [
                'film'  => $r['judul_film'],
                'total' => (int)$r['total']
            ];
        }

        return view('dashboard/index', [
            'title'           => 'Dashboard',
            'totalKasir'      => $totalKasir,
            'totalFilm'       => $totalFilm,
            'tiketTerjual'    => $tiketTerjual,
            'topFilm'         => $topFilm,
            'grafikPenjualan' => array_values($grafik),
            'tooltipFilm'     => $tooltipData
        ]);
    }
}

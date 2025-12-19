<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\JadwalTayangModel;

class Dashboard extends BaseController
{
    protected $jadwal;

    public function __construct()
    {
        $this->jadwal = new JadwalTayangModel();
    }

    public function index()
    {
        $data = $this->jadwal
            ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->join('room', 'room.id_room = jadwal_tayang.id_room')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('jam_mulai', 'ASC')
            ->findAll();

        return view('kasir/dashboard', [
            'jadwal' => $data
        ]);
    }
}

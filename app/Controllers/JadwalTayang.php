<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalTayangModel;
use App\Models\FilmModel;
use App\Models\RoomModel;
use App\Models\KursiModel;
use App\Models\KursiJadwalStatusModel;

class JadwalTayang extends BaseController
{
    protected $jadwal;
    protected $film;
    protected $room;
    protected $kursi;
    protected $kursiStatus;

    public function __construct()
    {
        $this->jadwal      = new JadwalTayangModel();
        $this->film        = new FilmModel();
        $this->room        = new RoomModel();
        $this->kursi       = new KursiModel();
        $this->kursiStatus = new KursiJadwalStatusModel();
    }

    public function index()
    {
        return view('jadwaltayang/index', [
            'data' => $this->jadwal
                ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
                ->join('film', 'film.id_film = jadwal_tayang.id_film')
                ->join('room', 'room.id_room = jadwal_tayang.id_room')
                ->findAll(),
            'film' => $this->film->findAll(),
            'room' => $this->room->findAll()
        ]);
    }

    public function add()
    {
        return view('jadwaltayang/form', [
            'film' => $this->film->findAll(),
            'room' => $this->room->findAll(),
            'mode' => 'add'
        ]);
    }

    public function create()
    {
        $data = [
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'harga'       => $this->request->getPost('harga'),
            'id_film'     => $this->request->getPost('id_film'),
            'id_room'     => $this->request->getPost('id_room')
        ];

        if (!$data['id_film'] || !$data['id_room']) {
            return redirect()->back()->with('error', 'Film dan Room wajib dipilih');
        }

        $idTayang = $this->jadwal->insert($data, true);

        //GENERATE kursi_jadwal_status
        $kursiList = $this->kursi->where('id_room', $data['id_room'])->findAll();

        $batch = [];
        foreach ($kursiList as $k) {
            $batch[] = [
                'id_kursi'  => $k->id_kursi,
                'id_tayang' => $idTayang,
                'status'    => 0 // 0 = tersedia
            ];
        }

        $this->kursiStatus->insertBatch($batch);

        return redirect()->to(base_url('jadwaltayang'));
    }

    public function update($id)
    {
        $this->jadwal->update($id, [
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'harga'       => $this->request->getPost('harga'),
            'id_film'     => $this->request->getPost('id_film'),
            'id_room'     => $this->request->getPost('id_room')
        ]);

        return redirect()->to(base_url('jadwaltayang'));
    }

    public function delete($id)
    {
        $this->jadwal->delete($id);
        return redirect()->to(base_url('jadwaltayang'));
    }
}

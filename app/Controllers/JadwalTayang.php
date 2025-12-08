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
    protected $db;
    protected $jadwal;
    protected $film;
    protected $room;
    protected $kursi;
    protected $kursiStatus;

    public function __construct()
    {
        $this->db          = \Config\Database::connect();
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
                ->select('jadwal_tayang.*, film.judul_film, film.harga_tiket AS harga, room.nama_room')
                ->join('film', 'film.id_film = jadwal_tayang.id_film')
                ->join('room', 'room.id_room = jadwal_tayang.id_room')
                ->findAll(),
            'film' => $this->film->findAll(),
            'room' => $this->room->findAll()
        ]);
    }

       public function create()
{
    $data = [
        'tanggal'     => $this->request->getPost('tanggal'),
        'jam_mulai'   => $this->request->getPost('jam_mulai'),
        'jam_selesai' => $this->request->getPost('jam_selesai'),
        'id_film'     => (int) $this->request->getPost('id_film'),
        'id_room'     => (int) $this->request->getPost('id_room'),
    ];

    $this->db->transStart();

    $idTayang = $this->jadwal->insert($data, true);

    if ($idTayang === false) {
        $this->db->transRollback();
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Gagal menyimpan jadwal tayang');
    }

    // generate kursi status
    $kursiList = $this->kursi
        ->where('id_room', $data['id_room'])
        ->findAll();

    $batch = [];
    foreach ($kursiList as $k) {
        $batch[] = [
            'id_kursi'  => $k->id_kursi,
            'id_tayang' => $idTayang,
            'status'    => 0,
            'id_order'  => null
        ];
    }

    if (! empty($batch)) {
        $this->kursiStatus->insertBatch($batch);
    }

    $this->db->transComplete();

    if ($this->db->transStatus() === false) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Terjadi kesalahan saat menyimpan kursi');
    }

    return redirect()
        ->to(base_url('jadwaltayang'))
        ->with('success', 'Jadwal tayang berhasil ditambahkan');
}

    public function update($id)
    {
        $this->jadwal->update($id, [
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'id_film'     => $this->request->getPost('id_film'),
            'id_room'     => $this->request->getPost('id_room')
        ]);

        return redirect()->to('/jadwaltayang');
    }

    public function delete($id)
{
    $this->db->transStart();

    // 1. Hapus semua kursi milik jadwal ini
    $this->kursiStatus
         ->where('id_tayang', $id)
         ->delete();

    // 2. Baru hapus jadwal tayang
    $this->jadwal->delete($id);

    $this->db->transComplete();

    if ($this->db->transStatus() === false) {
        return redirect()
            ->back()
            ->with('error', 'Gagal menghapus jadwal tayang');
    }

    return redirect()
        ->to(base_url('jadwaltayang'))
        ->with('success', 'Jadwal tayang berhasil dihapus');
}
}

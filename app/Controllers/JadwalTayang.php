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

        $today = date('Y-m-d');
    if ($data['tanggal'] < $today) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Tanggal tayang tidak boleh kurang dari hari ini');
    }

    if ($data['jam_selesai'] <= $data['jam_mulai']) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Jam selesai harus lebih besar dari jam mulai');
    }

    $bentrok = $this->jadwal
        ->where('tanggal', $data['tanggal'])
        ->where('id_room', $data['id_room'])
        ->groupStart()
            ->where('jam_mulai <', $data['jam_selesai'])
            ->where('jam_selesai >', $data['jam_mulai'])
        ->groupEnd()
        ->first();

    if ($bentrok) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Jadwal bentrok dengan jadwal lain di room yang sama');
    }

    $this->db->transStart();

    $idTayang = $this->jadwal->insert($data, true);

    if ($idTayang === false) {
        $this->db->transRollback();
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Gagal menyimpan jadwal tayang');
    }

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

    if (!empty($batch)) {
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
    $data = [
        'tanggal'     => $this->request->getPost('tanggal'),
        'jam_mulai'   => $this->request->getPost('jam_mulai'),
        'jam_selesai' => $this->request->getPost('jam_selesai'),
        'id_film'     => (int) $this->request->getPost('id_film'),
        'id_room'     => (int) $this->request->getPost('id_room'),
    ];

    $today = date('Y-m-d');

    if ($data['tanggal'] < $today) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Tanggal tayang tidak boleh kurang dari hari ini');
    }

    if ($data['jam_selesai'] <= $data['jam_mulai']) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Jam selesai harus lebih besar dari jam mulai');
    }

    $bentrok = $this->jadwal
        ->where('tanggal', $data['tanggal'])
        ->where('id_room', $data['id_room'])
        ->where('id_tayang !=', $id)
        ->groupStart()
            ->where('jam_mulai <', $data['jam_selesai'])
            ->where('jam_selesai >', $data['jam_mulai'])
        ->groupEnd()
        ->first();

    if ($bentrok) {
        return redirect()
            ->to(base_url('jadwaltayang'))
            ->with('error', 'Jadwal bentrok dengan jadwal lain di room yang sama');
    }

    $this->jadwal->update($id, $data);

    return redirect()
        ->to(base_url('jadwaltayang'))
        ->with('success', 'Jadwal tayang berhasil diperbarui');
}

    public function delete($id)
{
    $this->db->transStart();

    $this->kursiStatus
         ->where('id_tayang', $id)
         ->delete();

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

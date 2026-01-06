<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KursiJadwalStatus extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index($id_tayang)
{

    $jadwal = $this->db->table('jadwal_tayang jt')
        ->select('jt.*, room.nama_room, film.judul_film')
        ->join('room', 'room.id_room = jt.id_room')
        ->join('film', 'film.id_film = jt.id_film')
        ->where('jt.id_tayang', $id_tayang)
        ->get()
        ->getRow();

    if (!$jadwal) {
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan');
    }

    $data = $this->db->table('kursi_jadwal_status ks')
        ->select('ks.id_status, ks.id_kursi, ks.status, k.kode_kursi')
        ->join('kursi k', 'k.id_kursi = ks.id_kursi')
        ->where('ks.id_tayang', $id_tayang)
        ->orderBy(
            "LEFT(k.kode_kursi,1), CAST(SUBSTRING(k.kode_kursi,2) AS UNSIGNED)",
            '',
            false
        )
        ->get()
        ->getResult();

    return view('kursijadwalstatus/index', [
        'data'   => $data,
        'jadwal' => $jadwal
    ]);
}

    public function byOrder($id_order)
{
    $data = $this->db->table('kursi_jadwal_status')
        ->select('kursi_jadwal_status.*, kursi.kode_kursi')
        ->join('kursi', 'kursi.id_kursi = kursi_jadwal_status.id_kursi')
        ->where('kursi_jadwal_status.id_order', $id_order)
        ->get()->getResult();

    return view('kursijadwalstatus/order', [
        'data' => $data,
        'id_order' => $id_order
    ]);
}

    public function update()
{
    $id_kursi  = $this->request->getPost('id_kursi');
    $id_tayang = $this->request->getPost('id_tayang');
    $status    = $this->request->getPost('status');

    if (
        !$id_kursi ||
        !$id_tayang ||
        !in_array($status, ['0','1'], true)
    ) {
        return redirect()->back();
    }

    $this->db->table('kursi_jadwal_status')
        ->where('id_kursi', $id_kursi)
        ->where('id_tayang', $id_tayang)
        ->where('id_order IS NULL')
        ->update([
            'status' => $status
        ]);

    return redirect()->back();
}

}

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

    /**
     * =========================
     * STATUS KURSI PER ROOM
     * =========================
     */
    public function index()
    {
        // ambil semua room
        $rooms = $this->db->table('room')->get()->getResult();

        if (empty($rooms)) {
            return view('kursijadwalstatus/index', [
                'rooms'       => [],
                'data'        => [],
                'active_room' => null,
                'activeRoomName' => ''
            ]);
        }

        // default room pertama
        $id_room = $rooms[0]->id_room;

        if ($this->request->getGet('room')) {
            $id_room = $this->request->getGet('room');
        }

        // ✅ cari nama room (UNTUK VIEW)
        $activeRoomName = '';
        foreach ($rooms as $r) {
            if ($r->id_room == $id_room) {
                $activeRoomName = $r->nama_room;
                break;
            }
        }

        // ✅ QUERY KURSI (ADMIN STATUS)
        $data = $this->db->table('kursi k')
            ->select("
                k.id_kursi,
                k.kode_kursi,
                IF(ks.status IS NULL, 0, ks.status) AS status
            ")
            ->join(
                'kursi_jadwal_status ks',
                'ks.id_kursi = k.id_kursi AND ks.id_order IS NULL',
                'left'
            )
            ->where('k.id_room', $id_room)
            ->orderBy(
                "LEFT(k.kode_kursi,1) ASC, CAST(SUBSTRING(k.kode_kursi,2) AS UNSIGNED) ASC",
                '',
                false
            )
            ->get()
            ->getResult();

        return view('kursijadwalstatus/index', [
            'rooms'          => $rooms,
            'data'           => $data,
            'active_room'    => $id_room,
            'activeRoomName' => $activeRoomName
        ]);
    }

    public function update()
    {
        $id_kursi = $this->request->getPost('id_kursi');
        $status   = $this->request->getPost('status');

        if (!$id_kursi || !in_array($status, ['0','1'], true)) {
            return redirect()->back();
        }

        $existing = $this->db->table('kursi_jadwal_status')
            ->where('id_kursi', $id_kursi)
            ->where('id_order IS NULL')
            ->get()
            ->getRow();

        if ($existing) {
            $this->db->table('kursi_jadwal_status')
                ->where('id_status', $existing->id_status)
                ->update(['status' => $status]);
        } else {
            $this->db->table('kursi_jadwal_status')->insert([
                'id_kursi' => $id_kursi,
                'status'   => $status,
                'id_order' => null
            ]);
        }

        return redirect()->back();
    }
}

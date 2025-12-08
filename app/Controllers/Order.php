<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\JadwalTayangModel;

class Order extends BaseController
{
    protected $order;
    protected $jadwal;

    public function __construct()
    {
        $this->order  = new OrderModel();
        $this->jadwal = new JadwalTayangModel();
    }

    // ================= LIST =================
    public function index()
    {
        $orders = $this->order
            ->select('
                `order`.*,
                film.judul_film,
                room.nama_room,
                jadwal_tayang.tanggal,
                jadwal_tayang.jam_mulai,
                jadwal_tayang.jam_selesai
            ')
            ->join('jadwal_tayang', 'jadwal_tayang.id_tayang = `order`.id_tayang')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->join('room', 'room.id_room = jadwal_tayang.id_room')
            ->findAll();

        $jadwal = $this->jadwal
            ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->join('room', 'room.id_room = jadwal_tayang.id_room')
            ->findAll();

        return view('order/index', [
            'data'   => $orders,
            'jadwal' => $jadwal
        ]);
    }

    // ================= ADD (POST ONLY) =================
    public function add()
    {
        $dataInsert = [
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'id_tayang'    => (int) $this->request->getPost('id_tayang'),
            'total_bayar'  => (int) $this->request->getPost('total_bayar'),
            'status_order' => $this->request->getPost('status_order') ?? 'pending',
            'tanggal_order' => $this->request->getPost('tanggal_order'),
        ];

        if (
            !$dataInsert['nama_pemesan'] || 
            !$dataInsert['id_tayang'] || 
            !$dataInsert['tanggal_order']
        ) {
            return redirect()->to('/order')->with('error', 'Data wajib diisi');
        }

        if ($this->order->insert($dataInsert) === false) {
            return redirect()->to('/order')->with('error', json_encode($this->order->errors()));
        }

        return redirect()->to('/order')->with('success', 'Order berhasil ditambahkan');
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $this->order->update($id, [
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'id_tayang'    => $this->request->getPost('id_tayang'),
            'total_bayar'  => $this->request->getPost('total_bayar'),
            'status_order' => $this->request->getPost('status_order')
        ]);

        return redirect()->to('/order');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->order->delete($id);
        return redirect()->to('/order');
    }
}

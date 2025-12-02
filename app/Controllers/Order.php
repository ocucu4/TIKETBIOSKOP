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

        return view('order/index', [
            'mode' => 'list',
            'data' => $orders
        ]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {

            $data = [
                'nama_pemesan' => $this->request->getPost('nama_pemesan'),
                'total_bayar'  => $this->request->getPost('total_bayar'),
                'status_order' => $this->request->getPost('status_order') ?? 'pending',
                'id_tayang'    => $this->request->getPost('id_tayang'),
            ];

            if (!$data['nama_pemesan'] || !$data['id_tayang']) {
                return redirect()->back()->with('error', 'Nama pemesan dan jadwal wajib diisi');
            }

            $this->order->insert($data);
            return redirect()->to(base_url('order'));
        }

        $jadwal = $this->jadwal
            ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->join('room', 'room.id_room = jadwal_tayang.id_room')
            ->findAll();

        return view('order/index', [
            'mode'   => 'add',
            'jadwal' => $jadwal
        ]);
    }

    public function update($id)
    {
        $order = $this->order->find($id);
        if (!$order) {
            return redirect()->to(base_url('order'))->with('error', 'Order tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {

            $data = [
                'nama_pemesan' => $this->request->getPost('nama_pemesan'),
                'total_bayar'  => $this->request->getPost('total_bayar'),
                'status_order' => $this->request->getPost('status_order'),
                'id_tayang'    => $this->request->getPost('id_tayang'),
            ];

            if (!$data['nama_pemesan'] || !$data['id_tayang']) {
                return redirect()->back()->with('error', 'Data wajib diisi');
            }

            $this->order->update($id, $data);
            return redirect()->to(base_url('order'));
        }

        $jadwal = $this->jadwal
            ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->join('room', 'room.id_room = jadwal_tayang.id_room')
            ->findAll();

        return view('order/index', [
            'mode'   => 'edit',
            'data'   => $order,
            'jadwal' => $jadwal
        ]);
    }

    public function delete($id)
    {
        $this->order->delete($id);
        return redirect()->to(base_url('order'));
    }
}

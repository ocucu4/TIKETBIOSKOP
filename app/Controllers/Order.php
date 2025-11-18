<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\FilmModel;
use App\Models\RoomModel;

class Order extends BaseController
{
    protected $order;
    protected $film;
    protected $room;

    public function __construct()
    {
        $this->order = new OrderModel();
        $this->film  = new FilmModel();
        $this->room  = new RoomModel();
    }

    public function index()
    {
        $data['data'] = $this->order
            ->select('order.*, film.judul_film, room.nama_room')
            ->join('film', 'film.id_film = order.id_film')
            ->join('room', 'room.id_room = order.id_room')
            ->findAll();

        return view('order/index', $data);
    }

    public function tambah()
    {
        $data['films'] = $this->film->findAll();
        $data['rooms'] = $this->room->findAll();

        return view('order/tambah', $data);
    }

    public function add()
    {
        $data = [
            'nama_pemesan'   => $this->request->getPost('nama_pemesan'),
            'tanggal_order'  => $this->request->getPost('tanggal_order'),
            'total_bayar'    => $this->request->getPost('total_bayar'),
            'status_order'   => $this->request->getPost('status_order'),
            'id_film'        => $this->request->getPost('id_film'),
            'id_room'        => $this->request->getPost('id_room'),
        ];

        $this->order->insert($data);

        return redirect()->to(base_url('order'));
    }

    public function ubah($id)
    {
        $data['data']  = $this->order->find($id);
        $data['films'] = $this->film->findAll();
        $data['rooms'] = $this->room->findAll();

        return view('order/ubah', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_pemesan'   => $this->request->getPost('nama_pemesan'),
            'tanggal_order'  => $this->request->getPost('tanggal_order'),
            'total_bayar'    => $this->request->getPost('total_bayar'),
            'status_order'   => $this->request->getPost('status_order'),
            'id_film'        => $this->request->getPost('id_film'),
            'id_room'        => $this->request->getPost('id_room'),
        ];

        $this->order->update($id, $data);

        return redirect()->to(base_url('order'));
    }

    public function delete($id)
    {
        $this->order->delete($id);
        return redirect()->to(base_url('order'));
    }
}

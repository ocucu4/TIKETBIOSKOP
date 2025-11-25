<?php

namespace App\Controllers;
use App\Models\RoomModel;
use App\Models\JadwalTayangModel;

class Room extends BaseController
{
    protected $room;
    protected $tayang;

    public function __construct() {
        $this->room   = new RoomModel();
        $this->tayang = new JadwalTayangModel();
    }

    public function index(): string
    {
        $data['data']   = $this->room->findAll();
        $data['tayang'] = $this->tayang->findAll();
        return view('room/index', $data);
    }

    public function tambah()
    {
        $data['tayang'] = $this->tayang->findAll();
        return view('room/tambah', $data);
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->room->insert($param);
        return redirect()->to(base_url('room'));
    }

    public function ubah($id)
    {
        $data['data']   = $this->room->find($id);
        $data['tayang'] = $this->tayang->findAll();
        return view('room/ubah', $data);
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->room->update($id, $param);
        return redirect()->to(base_url('room'));
    }

    public function hapus($id)
    {
        $this->room->delete($id);
        return redirect()->to(base_url('room'));
    }
}

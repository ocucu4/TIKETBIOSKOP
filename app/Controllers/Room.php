<?php

namespace App\Controllers;
use App\Models\RoomModel;

class Room extends BaseController
{
    protected $room;

    public function __construct() {
        $this->room = new RoomModel();
    }

    public function index(): string
    {
        $data = $this->room->findAll();
        return view('room/index', ['data' => $data]);
    }

    public function tambah()
    {
        return view('room/tambah');
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->room->insert($param);

        return redirect()->to(base_url('room'));
    }

    public function ubah($id)
    {
        $data = $this->room->find($id);
        return view('room/ubah', ['data' => $data]);
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

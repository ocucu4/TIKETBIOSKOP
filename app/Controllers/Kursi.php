<?php

namespace App\Controllers;

use App\Models\KursiModel;
use App\Models\RoomModel;

class Kursi extends BaseController
{
    protected $kursi;

    public function __construct()
    {
        $this->kursi = new KursiModel();
    }

    public function index()
    {
        $data['data'] = $this->kursi->findAll();
        return view('kursi/index', $data);
    }

    public function tambah()
    {
        $roomModel = new RoomModel();
        $data['room'] = $roomModel->findAll();

        return view('kursi/tambah', $data);
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->kursi->insert($param);

        return redirect()->to(base_url('kursi'));
    }

    public function ubah($id)
    {
        $data['data'] = $this->kursi->find($id);
        return view('kursi/ubah', $data);
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->kursi->update($id, $param);

        return redirect()->to(base_url('kursi'));
    }

    public function delete($id)
    {
        $this->kursi->delete($id);
        return redirect()->to(base_url('kursi'));
    }
}

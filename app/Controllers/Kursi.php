<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KursiModel;
use App\Models\RoomModel;

class Kursi extends BaseController
{
    protected $kursi;
    protected $room;

    public function __construct()
    {
        $this->kursi = new KursiModel();
        $this->room  = new RoomModel();
    }

    public function index()
    {
        $data['data'] = $this->kursi
            ->select('kursi.*, room.nama_room, room.kapasitas')
            ->join('room', 'room.id_room = kursi.id_room', 'left')
            ->findAll();

        $data['room'] = $this->room->findAll();

        return view('kursi/index', $data);
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->kursi->insert($param);

        return redirect()->to(base_url('kursi'))
                         ->with('success', 'Kursi berhasil ditambahkan!');
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->kursi->update($id, $param);

        return redirect()->to(base_url('kursi'))
                         ->with('success', 'Kursi berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $this->kursi->delete($id);

        return redirect()->to(base_url('kursi'))
                         ->with('success', 'Kursi berhasil dihapus!');
    }
}

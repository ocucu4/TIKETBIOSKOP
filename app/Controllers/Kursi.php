<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KursiModel;

class Kursi extends BaseController
{
    protected $kursi;

    public function __construct()
    {
        $this->kursi = new KursiModel();
    }

    public function index()
    {
        $data = $this->kursi
            ->select("
                kursi.*,
                room.nama_room,
                SUBSTRING(kursi.kode_kursi, 1, 1) AS baris,
                CAST(SUBSTRING(kursi.kode_kursi, 2) AS UNSIGNED) AS nomor
            ")
            ->join('room', 'room.id_room = kursi.id_room')
            ->orderBy('room.nama_room')
            ->orderBy('baris')
            ->orderBy('nomor')
            ->findAll();

        return view('kursi/index', [
            'data' => $data
        ]);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');

        if (!in_array($status, ['0', '1'], true)) {
            return redirect()->back();
        }

        $this->kursi->update($id, [
            'status' => $status
        ]);

        return redirect()->to(site_url('kursi'));
    }
}

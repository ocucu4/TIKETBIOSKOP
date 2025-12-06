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
    $db = \Config\Database::connect();

    $data = $db->table('kursi k')
        ->select("
            k.id_kursi,
            k.kode_kursi,
            r.nama_room,
            SUBSTRING(k.kode_kursi,1,1) AS baris,
            CAST(SUBSTRING(k.kode_kursi,2) AS UNSIGNED) AS nomor,
            IF(ks.status IS NULL, 0, ks.status) AS status
        ")
        ->join('room r', 'r.id_room = k.id_room')
        ->join(
            'kursi_jadwal_status ks',
            'ks.id_kursi = k.id_kursi AND ks.id_order IS NULL',
            'left'
        )
        ->orderBy('r.nama_room', 'ASC')
        ->orderBy('baris', 'ASC')
        ->orderBy('nomor', 'ASC')
        ->get()
        ->getResult();

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

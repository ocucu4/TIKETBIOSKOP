<?php

namespace App\Controllers;

use App\Models\KursiJadwalStatusModel;
use App\Models\JadwalTayangModel;
use App\Models\KursiModel;

class KursiJadwalStatus extends BaseController
{
    protected $status;

    public function __construct()
    {
        $this->status = new KursiJadwalStatusModel();
    }

    public function index()
    {
        return view("kursi_jadwal_status/index", [
            'data' => $this->status->findAll()
        ]);
    }

    public function tambah()
    {
        $jadwal = new JadwalTayangModel();
        $kursi  = new KursiModel();

        return view("kursi_jadwal_status/tambah", [
            'jadwal' => $jadwal->findAll(),
            'kursi' => $kursi->findAll()
        ]);
    }

    public function simpan()
    {
        $this->status->save([
            'status' => $this->request->getPost('status'),
            'jadwal_tayang_id_tayang' => $this->request->getPost('id_tayang'),
            'kursi_id_kursi' => $this->request->getPost('id_kursi'),
        ]);

        return redirect()->to('/kursi_jadwal_status');
    }
}

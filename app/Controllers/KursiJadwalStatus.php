<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KursiJadwalStatusModel;
use App\Models\KursiModel;
use App\Models\OrderModel;
use App\Models\JadwalTayangModel;

class KursiJadwalStatus extends BaseController
{
    protected $status;
    protected $kursi;
    protected $order;
    protected $tayang;

    public function __construct()
    {
        $this->status = new KursiJadwalStatusModel();
        $this->kursi  = new KursiModel();
        $this->order  = new OrderModel();
        $this->tayang = new JadwalTayangModel();
    }

    public function index()
    {
        $data['data'] = $this->status
            ->select('kursi_jadwal_status.*, k.kode_kursi, o.id_order, j.tanggal')
            ->join('kursi k', 'k.id_kursi = kursi_jadwal_status.id_kursi', 'left')
            ->join('`order` o', 'o.id_order = kursi_jadwal_status.id_order', 'left')
            ->join('jadwal_tayang j', 'j.id_tayang = kursi_jadwal_status.id_tayang', 'left')
            ->findAll();

        $data['kursi']  = $this->kursi->findAll();
        $data['order']  = $this->order->findAll();
        $data['tayang'] = $this->tayang->findAll();

        return view('kursijadwalstatus/index', $data);
    }

    public function simpan()
    {
        $this->status->insert($this->request->getPost());
        return redirect()->to(base_url('kursijadwalstatus'));
    }

    public function update($id)
    {
        $this->status->update($id, $this->request->getPost());
        return redirect()->to(base_url('kursijadwalstatus'));
    }

    public function hapus($id)
    {
        $this->status->delete($id);
        return redirect()->to(base_url('kursijadwalstatus'));
    }
}

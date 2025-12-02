<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KursiJadwalStatusModel;

class KursiJadwalStatus extends BaseController
{
    protected $status;

    public function __construct()
    {
        $this->status = new KursiJadwalStatusModel();
    }

    /**
     * =========================
     * ADMIN
     * MELIHAT & UPDATE STATUS KURSI
     * =========================
     */
    public function index()
    {
        $data['data'] = $this->status
            ->select('kursi_jadwal_status.*, kursi.kode_kursi')
            ->join('kursi', 'kursi.id_kursi = kursi_jadwal_status.id_kursi')
            ->orderBy('kursi.kode_kursi', 'ASC')
            ->findAll();

        return view('kursijadwalstatus/index', $data);
    }

    /**
     * =========================
     * UPDATE STATUS
     * =========================
     */
    public function update($id_status)
    {
        $status = $this->request->getPost('status');

        if ($status === null) {
            return redirect()->back();
        }

        $this->status->update($id_status, [
            'status' => $status
        ]);

        return redirect()->to(base_url('kursijadwalstatus'));
    }
}

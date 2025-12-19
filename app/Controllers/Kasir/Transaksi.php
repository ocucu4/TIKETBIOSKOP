<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\JadwalTayangModel;
use App\Models\OrderModel;
use App\Models\PembayaranModel;
use App\Models\KursiJadwalStatusModel;
use App\Models\KursiModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $jadwal = (new JadwalTayangModel())
            ->select('jadwal_tayang.*, film.judul_film, room.nama_room')
            ->join('film','film.id_film=jadwal_tayang.id_film')
            ->join('room','room.id_room=jadwal_tayang.id_room')
            ->findAll();

        return view('kasir/dashboard', compact('jadwal'));
    }

    public function kursi($id_tayang)
{
    $kursi = (new KursiJadwalStatusModel())
        ->select('kursi.id_kursi, kursi.kode_kursi, kursi_jadwal_status.status')
        ->join('kursi', 'kursi.id_kursi = kursi_jadwal_status.id_kursi')
        ->where('kursi_jadwal_status.id_tayang', $id_tayang)
        ->findAll();

    // ✅ SORT NUMERIK: A1 A2 A3 ... A30
    usort($kursi, function ($a, $b) {
        $rowA = substr($a->kode_kursi, 0, 1);
        $rowB = substr($b->kode_kursi, 0, 1);

        if ($rowA !== $rowB) {
            return strcmp($rowA, $rowB);
        }

        $numA = (int) substr($a->kode_kursi, 1);
        $numB = (int) substr($b->kode_kursi, 1);

        return $numA <=> $numB;
    });

    return view('kasir/transaksi/kursi', [
        'id_tayang' => $id_tayang,
        'kursi'     => $kursi
    ]);
}


    public function buatOrder()
    {
        $id = (new OrderModel())->insert([
            'nama_pemesan' => $this->request->getPost('nama'),
            'id_tayang'    => $this->request->getPost('id_tayang'),
            'status_order' => 'pending'
        ], true);

        return redirect()->to('/kasir/bayar/'.$id);
    }

    public function bayar($id_order)
    {
        return view('kasir/transaksi/bayar', compact('id_order'));
    }

    public function proses()
{
    (new PembayaranModel())->insert([
        'id_order'      => $this->request->getPost('id_order'),
        'metode_bayar'  => $this->request->getPost('metode'),
        'jumlah_bayar'  => $this->request->getPost('total'),
        'tanggal_bayar' => date('Y-m-d H:i:s'),
        'keterangan'    => 'Lunas'
    ]);

    return redirect()
        ->to('/kasir/dashboard')
        ->with('success', 'Transaksi berhasil');
    }
}

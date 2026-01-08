<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\OrderModel;

class Pembayaran extends BaseController
{
    protected $pembayaran;
    protected $order;
    protected $db;

    public function __construct()
    {
        $this->pembayaran = new PembayaranModel();
        $this->order      = new OrderModel();
        $this->db         = \Config\Database::connect();
    }

    public function index()
    {
        $data = $this->pembayaran
            ->select('pembayaran.*, `order`.nama_pemesan, `order`.status_order')
            ->join('order', 'order.id_order = pembayaran.id_order')
            ->findAll();

        return view('pembayaran/index', [
            'data'   => $data,
            'orders' => $this->order->findAll()
        ]);
    }

    public function add()
    {
        $data = [
            'id_order'      => (int) $this->request->getPost('id_order'),
            'metode_bayar'  => $this->request->getPost('metode_bayar'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'jumlah_bayar'  => (float) $this->request->getPost('jumlah_bayar'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $order = $this->order->find($data['id_order']);
        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan');
        }

        if ($data['jumlah_bayar'] < $order->total_bayar) {
            return redirect()->back()->with('error', 'Jumlah bayar kurang dari total order');
        }

        $exist = $this->pembayaran
            ->where('id_order', $data['id_order'])
            ->countAllResults();

        if ($exist > 0) {
            return redirect()->back()->with('error', 'Order ini sudah dibayar');
        }

        $this->db->transBegin();

        $this->pembayaran->insert($data);

        if ($data['keterangan'] === 'Lunas') {

            $this->order->update($data['id_order'], [
                'status_order' => 'lunas'
            ]);

            $kursiList = $this->db->table('detail_order')
                ->select('id_kursi')
                ->where('id_order', $data['id_order'])
                ->get()
                ->getResult();

            foreach ($kursiList as $k) {
                $this->db->table('kursi_jadwal_status')
                    ->where('id_kursi', $k->id_kursi)
                    ->where('id_tayang', $order->id_tayang)
                    ->update([
                        'status'   => 1,
                        'id_order' => $data['id_order']
                    ]);
            }
        }

        $this->db->transCommit();

        return redirect()->to('/pembayaran')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'metode_bayar'  => $this->request->getPost('metode_bayar'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'jumlah_bayar'  => (float) $this->request->getPost('jumlah_bayar'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $pembayaran = $this->pembayaran->find($id);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        $order = $this->order->find($pembayaran->id_order);
        if ($data['jumlah_bayar'] < $order->total_bayar) {
            return redirect()->back()->with('error', 'Jumlah bayar kurang dari total order');
        }

        $this->db->transBegin();

        $this->pembayaran->update($id, $data);

        if ($data['keterangan'] === 'Lunas') {

            $this->order->update($order->id_order, [
                'status_order' => 'lunas'
            ]);

            $this->db->table('kursi_jadwal_status')
                ->where('id_order', $order->id_order)
                ->update(['status' => 1]);

        } else {

            $this->order->update($order->id_order, [
                'status_order' => 'belum_bayar'
            ]);

            $this->db->table('kursi_jadwal_status')
                ->where('id_order', $order->id_order)
                ->update([
                    'status'   => 0,
                    'id_order' => null
                ]);
        }

        $this->db->transCommit();

        return redirect()->to('/pembayaran')->with('success', 'Pembayaran berhasil diubah');
    }

    public function delete($id)
    {
        $pembayaran = $this->pembayaran->find($id);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        $this->db->transBegin();

        $this->pembayaran->delete($id);

        $this->order->update($pembayaran->id_order, [
            'status_order' => 'belum_bayar'
        ]);

        $this->db->table('kursi_jadwal_status')
            ->where('id_order', $pembayaran->id_order)
            ->update([
                'status'   => 0,
                'id_order' => null
            ]);

        $this->db->transCommit();

        return redirect()->to('/pembayaran')->with('success', 'Pembayaran berhasil dihapus');
    }
}

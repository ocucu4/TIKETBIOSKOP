<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\OrderModel;

class Pembayaran extends BaseController
{
    protected $pembayaran;
    protected $order;

    public function __construct()
    {
        $this->pembayaran = new PembayaranModel();
        $this->order      = new OrderModel();
    }

    public function index()
    {
        $data = $this->pembayaran
            ->select('pembayaran.*, `order`.nama_pemesan, `order`.status_order')
            // JANGAN pakai backtick di parameter join()
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

        if (!$data['id_order'] || !$data['jumlah_bayar']) {
            return redirect()->back()->with('error', 'Order dan jumlah bayar wajib diisi');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $this->pembayaran->insert($data);

        // otomatis set status order = lunas
        $this->order->update($data['id_order'], [
            'status_order' => 'lunas'
        ]);

        $db->transComplete();

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

        if (!$data['jumlah_bayar']) {
            return redirect()->back()->with('error', 'Jumlah bayar wajib diisi');
        }

        $this->pembayaran->update($id, $data);

        return redirect()->to('/pembayaran')->with('success', 'Pembayaran berhasil diubah');
    }

    public function delete($id)
    {
        $this->pembayaran->delete($id);
        return redirect()->to('/pembayaran')->with('success', 'Pembayaran berhasil dihapus');
    }
}

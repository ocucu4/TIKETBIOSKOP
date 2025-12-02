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
        return view('pembayaran/index', [
            'title' => 'Pembayaran',
            'data'  => $this->pembayaran
                ->select('pembayaran.*, `order`.status_order')
                ->join('`order`', '`order`.id_order = pembayaran.id_order')
                ->findAll()
        ]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {

            $data = [
                'id_order'      => $this->request->getPost('id_order'),
                'metode_bayar'  => $this->request->getPost('metode_bayar'),
                'jumlah_bayar'  => $this->request->getPost('jumlah_bayar'),
                'keterangan'    => $this->request->getPost('keterangan')
            ];

            if (!$data['id_order'] || !$data['jumlah_bayar']) {
                return redirect()->back()->with('error', 'Order dan jumlah bayar wajib diisi');
            }

            $db = \Config\Database::connect();
            $db->transStart();

            $this->pembayaran->insert($data);
            $this->order->update($data['id_order'], [
                'status_order' => 'lunas'
            ]);

            $db->transComplete();

            return redirect()->to(base_url('pembayaran'));
        }

        return view('pembayaran/form', [
            'title'  => 'Tambah Pembayaran',
            'orders' => $this->order->findAll(),
            'mode'   => 'add'
        ]);
    }

    public function edit($id)
    {
        return view('pembayaran/form', [
            'title' => 'Ubah Pembayaran',
            'row'   => $this->pembayaran->find($id),
            'mode'  => 'edit'
        ]);
    }

    public function update($id)
    {
        $data = [
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'jumlah_bayar' => $this->request->getPost('jumlah_bayar'),
            'keterangan'   => $this->request->getPost('keterangan')
        ];

        if (!$data['jumlah_bayar']) {
            return redirect()->back()->with('error', 'Jumlah bayar wajib diisi');
        }

        $this->pembayaran->update($id, $data);
        return redirect()->to(base_url('pembayaran'));
    }

    public function delete($id)
    {
        $this->pembayaran->delete($id);
        return redirect()->to(base_url('pembayaran'));
    }
}

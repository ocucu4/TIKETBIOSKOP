<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
    protected $pembayaran;

    public function __construct()
    {
        $this->pembayaran = new PembayaranModel();
    }

    public function index()
    {
        $data['title'] = 'Pembayaran';
        $data['data'] = $this->pembayaran
              ->select('pembayaran.*, order.status_order')
              ->join('order', 'order.id_order = pembayaran.id_order')
              ->findAll();
        return view('pembayaran/index', $data);
    }

    public function tambah()
    {
        $orderModel = new \App\Models\OrderModel();

        $data['title'] = 'Tambah Pembayaran';
        $data['orders'] = $orderModel->findAll();

        return view('pembayaran/tambah', $data);
    }

    public function add()
    {
        $data = $this->request->getPost();

        $this->pembayaran->insert($data);

        $orderModel = new \App\Models\OrderModel();
        $orderModel->update($data['id_order'], [
        'status_order' => 'lunas'
    ]);

        return redirect()->to(base_url('pembayaran'));
    }

    public function ubah($id)
    {
        $data['title'] = 'Ubah Pembayaran';
        $data['row'] = $this->pembayaran->find($id);
        return view('pembayaran/ubah', $data);
    }

    public function update()
    {
        $post = $this->request->getPost();
        $id = $post['id_pembayaran'];

        $this->pembayaran->update($id, $post);

        $orderModel = new \App\Models\OrderModel();
        $orderModel->update($post['id_order'], [
        'status_order' => 'lunas'
    ]);

        return redirect()->to(base_url('pembayaran'));

    }

    public function hapus($id)
    {
        $this->pembayaran->delete($id);
        return redirect()->to(base_url('pembayaran'));
    }
}

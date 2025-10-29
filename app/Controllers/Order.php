<?php

namespace App\Controllers;

use App\Models\FilmModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;

class Order extends Controller
{
    protected $filmModel;
    protected $orderModel;

    public function __construct()
    {
        $this->filmModel = new FilmModel();
        $this->orderModel = new OrderModel();
    }

    // tampilkan form pemesanan
    public function create($id_film = null)
    {
        if ($id_film === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("ID film tidak disediakan");
        }

        $film = $this->filmModel->find($id_film);
        if (!$film) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Film tidak ditemukan (id: $id_film)");
        }

        // jika view berada di folder Views/order/order_form.php
        return view('order/order_form', ['film' => $film]);
    }

    // simpan data pesanan ke database
    public function store()
    {
        // sederhana: validasi server-side minimal
        $nama = $this->request->getPost('nama_pemesan');
        $id_film = (int)$this->request->getPost('id_film');
        $jumlah = (int)$this->request->getPost('jumlah_tiket');
        $total = (int)$this->request->getPost('total_bayar');

        if (empty($nama) || $id_film <= 0 || $jumlah <= 0) {
            return redirect()->back()->with('error', 'Data pemesanan tidak lengkap atau tidak valid');
        }

        $data = [
            'nama_pemesan' => $nama,
            'id_film' => $id_film,
            'jumlah_tiket' => $jumlah,
            'total_bayar' => $total,
            'tanggal_order' => date('Y-m-d H:i:s')
        ];

        $this->orderModel->insert($data);
        return redirect()->to('/order/success');
    }

    // tampilkan pesan sukses
    public function success()
    {
        return view('order/order_success');
    }
}

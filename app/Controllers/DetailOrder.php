<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailOrderModel;

class DetailOrder extends BaseController
{
    protected $detailorder;

    public function __construct()
    {
        $this->detailorder = new DetailOrderModel();
    }

        public function index()
    {
        $data['title'] = 'Detail Order';
        $data['data']  = $this->detailorder
                            ->select('detail_order.*, order.id_order, kursi.kode_kursi')
                            ->join('order', 'order.id_order = detail_order.id_order', 'left')
                            ->join('kursi', 'kursi.id_kursi = detail_order.id_kursi', 'left')
                            ->findAll();
        return view('detailorder/index', $data);
    }

    public function tambah()
    {
        $orderModel = new \App\Models\OrderModel();
        $kursiModel = new \App\Models\KursiModel();
        
        $data['title']  = 'Tambah Detail Order';
        $data['orders'] = $orderModel->findAll();
        $data['kursi']  = $kursiModel->findAll();

        return view('detailorder/tambah', $data);
    }

    public function add()
    {
        $param = $this->request->getPost();

        $this->detailorder->insert($param);

        return redirect()->to(base_url('detailorder'))->with('success', 'Detail Order berhasil ditambahkan!');
    }

    public function ubah($id)
    {
        $orderModel = new \App\Models\OrderModel();
        $kursiModel = new \App\Models\KursiModel();

        $data['title']  = 'Ubah Detail Order';
        $data['row']    = $this->detailorder->find($id);
        $data['orders'] = $orderModel->findAll();
        $data['kursi']  = $kursiModel->findAll();

        return view('detailorder/ubah', $data);
    }

    public function update($id)
    {
        $param = $this->request->getPost();

        $this->detailorder->update($id, $param);

        return redirect()->to(base_url('detailorder'))->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->detailorder->delete($id);

        return redirect()->to(base_url('detailorder'))->with('success', 'Data berhasil dihapus!');
    }
}

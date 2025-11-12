<?php

namespace App\Controllers;
use App\Models\DetailOrderModel;

class DetailOrder extends BaseController
{
    protected $detailOrder;

    public function __construct() {
        $this->detailOrder = new DetailOrderModel();
    }

    public function index(): string
    {
        $data = $this->detailOrder->findAll();
        return view('detail_order/index', ['data' => $data]);
    }

    public function tambah()
    {
        return view('detail_order/tambah');
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->detailOrder->insert($param);
        return redirect()->to(base_url('detailorder'));
    }

    public function ubah()
    {
        return view('detail_order/ubah');
    }

    public function update()
    {
        $param = $this->request->getPost();
        $this->detailOrder->insert($param);
        return redirect()->to(base_url('detailorder'));
    }

    public function delete($id)
    {
        $this->detailOrder->delete($id);
        return redirect()->to(base_url('detailorder'));
    }
}

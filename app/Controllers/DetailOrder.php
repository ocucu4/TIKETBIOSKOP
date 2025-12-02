<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\KursiModel;

class DetailOrder extends BaseController
{
    protected $detailOrder;
    protected $order;
    protected $kursi;

    public function __construct()
    {
        $this->detailOrder = new DetailOrderModel();
        $this->order = new OrderModel();
        $this->kursi = new KursiModel();
    }

    public function index()
    {
        return view('detailorder/index', [
            'title' => 'Detail Order',
            'data'  => $this->detailOrder
                ->select('detail_order.*, order.id_order, kursi.kode_kursi')
                ->join('order', 'order.id_order = detail_order.id_order', 'left')
                ->join('kursi', 'kursi.id_kursi = detail_order.id_kursi', 'left')
                ->findAll()
        ]);
    }

    public function add()
    {
        return view('detailorder/form', [
            'title'  => 'Tambah Detail Order',
            'orders' => $this->order->findAll(),
            'kursi'  => $this->kursi->findAll(),
            'mode'   => 'add'
        ]);
    }

    public function create()
    {
        $data = [
            'id_order' => $this->request->getPost('id_order'),
            'id_kursi' => $this->request->getPost('id_kursi'),
            'jumlah'   => $this->request->getPost('jumlah'),
            'subtotal' => $this->request->getPost('subtotal')
        ];

        if (!$data['id_order'] || !$data['id_kursi']) {
            return redirect()->back()->with('error', 'Order dan Kursi wajib dipilih');
        }

        $this->detailOrder->insert($data);
        return redirect()->to(base_url('detailorder'));
    }

    public function edit($id)
    {
        return view('detailorder/form', [
            'title'  => 'Ubah Detail Order',
            'row'    => $this->detailOrder->find($id),
            'orders' => $this->order->findAll(),
            'kursi'  => $this->kursi->findAll(),
            'mode'   => 'edit'
        ]);
    }

    public function update($id)
    {
        $this->detailOrder->update($id, [
            'id_order' => $this->request->getPost('id_order'),
            'id_kursi' => $this->request->getPost('id_kursi'),
            'jumlah'   => $this->request->getPost('jumlah'),
            'subtotal' => $this->request->getPost('subtotal')
        ]);

        return redirect()->to(base_url('detailorder'));
    }

    public function delete($id)
    {
        $this->detailOrder->delete($id);
        return redirect()->to(base_url('detailorder'));
    }
}

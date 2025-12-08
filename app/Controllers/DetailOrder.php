<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailOrderModel;

class DetailOrder extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index($id_order)
    {
        $data = $this->db->table('detail_order d')
            ->select('
                d.id_detail,
                o.nama_pemesan,
                d.jumlah,
                d.subtotal,
                o.status_order,
                o.tanggal_order
            ')
            ->join('order o', 'o.id_order = d.id_order')
            ->where('d.id_order', $id_order)
            ->get()
            ->getResult();

        return view('detailorder/index', [
            'data' => $data
        ]);
    }

    public function delete($id_detail)
    {
        $this->db->table('detail_order')
            ->where('id_detail', $id_detail)
            ->delete();

        return redirect()->back();
    }
}

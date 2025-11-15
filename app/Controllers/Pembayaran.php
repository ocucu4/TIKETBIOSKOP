<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PembayaranModelModel;
use CodeIgniter\HTTP\ResponseInterface;

class Room extends BaseController
{
    protected $Pembayaran;

    public function __construct() {
        $this->Pembayaran = new PembayaranModel();
    }

    public function index()
    {
        $data['bioskop'] = $this->Pembayaran->first();
        return view('bioskop/index', $data);
    }

    public function tambah()
    {
        



        return view('bioskop/tambah');
    }
    public function ubah()
    {
        


        return view('bioskop/ubah');
    }

    public function hapus($id)
    {
        $this->Pembayaran->delete($id);
        redirect()->to(base_url('bioskop/index'));
    }
}

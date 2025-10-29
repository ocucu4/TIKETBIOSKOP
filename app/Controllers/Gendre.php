<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GendreModel;
use CodeIgniter\HTTP\ResponseInterface;

class Gendre extends BaseController
{
    protected $gendre;

    public function __construct() {
        $this->gendre = new GendreModel();
    }

    public function index()
    {
        $data['gendre'] = $this->gendre->first();
        return view('gendre/index', $data);
    }

    public function tambah()
    {
        



        return view('gendre/tambah');
    }
    public function ubah()
    {
        


        return view('gendre/ubah');
    }

    public function hapus($id)
    {
        $this->gendre->delete($id);
        redirect()->to(base_url('gendre/index'));
    }
}

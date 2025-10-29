<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BioskopModel;
use CodeIgniter\HTTP\ResponseInterface;

class Room extends BaseController
{
    protected $bioskop;

    public function __construct() {
        $this->bioskop = new BioskopModel();
    }

    public function index()
    {
        $data['bioskop'] = $this->bioskop->first();
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
        $this->bioskop->delete($id);
        redirect()->to(base_url('bioskop/index'));
    }
}

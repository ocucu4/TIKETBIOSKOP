<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BioskopModel;
use CodeIgniter\HTTP\ResponseInterface;

class Room extends BaseController
{
    protected $Genre;

    public function __construct() {
        $this->Genre = new BioskopModel();
    }

    public function index()
    {
        $data['bioskop'] = $this->Genre->first();
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
        $this->Genre->delete($id);
        redirect()->to(base_url('bioskop/index'));
    }
}

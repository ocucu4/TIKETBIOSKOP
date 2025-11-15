<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use CodeIgniter\HTTP\ResponseInterface;

class Room extends BaseController
{
    protected $Room;

    public function __construct() {
        $this->Room= new RoomModel();
    }

    public function index()
    {
        $data['bioskop'] = $this->Room->first();
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
        $this->Room->delete($id);
        redirect()->to(base_url('bioskop/index'));
    }
}

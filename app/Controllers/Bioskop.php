<?php

namespace App\Controllers;
use App\Models\BioskopModel;

class Bioskop extends BaseController
{
    protected $bioskop;

    public function __construct() {
        $this->bioskop = new BioskopModel();
    }

    public function index(): string
    {
        $data = $this->bioskop->findAll();
        return view('bioskop/index', ['data' => $data]);
    }

    public function tambah()
    {
        return view('bioskop/tambah');
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->bioskop->insert($param);
        return redirect()->to(base_url('bioskop'));
    }

    public function ubah()
    {
        return view('bioskop/ubah');
    }

    public function update()
    {
        $param = $this->request->getPost();
        $this->bioskop->insert($param);
        return redirect()->to(base_url('bioskop'));
    }

    public function delete($id)
    {
        $this->bioskop->delete($id);
        return redirect()->to(base_url('bioskop'));
    }
}

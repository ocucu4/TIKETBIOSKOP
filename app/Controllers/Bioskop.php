<?php

namespace App\Controllers;

use App\Models\BioskopModel;

class Bioskop extends BaseController
{
    protected $bioskop;

    public function __construct()
    {
        $this->bioskop = new BioskopModel();
    }

    public function index()
    {
        $data['data'] = $this->bioskop->findAll();
        return view('bioskop/index', $data);
    }

    public function simpan()
    {
        $param = $this->request->getPost();
        $this->bioskop->insert($param);

        return redirect()->to(base_url('bioskop'));
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->bioskop->update($id, $param);

        return redirect()->to(base_url('bioskop'));
    }

    public function hapus($id)
    {
        $this->bioskop->delete($id);
        return redirect()->to(base_url('bioskop'));
    }
}

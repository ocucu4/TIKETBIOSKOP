<?php

namespace App\Controllers;
use App\Models\GenreModel;

class Genre extends BaseController
{
    protected $genre;

    public function __construct() {
        $this->genre = new GenreModel();
    }

    public function index()
    {
        $data['data'] = $this->genre->findAll();
        return view('genre/index', $data);
    }

    public function simpan()
    {
        $param = $this->request->getPost();
        $this->genre->insert($param);

        return redirect()->to(base_url('genre'));
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->genre->update($id, $param);

        return redirect()->to(base_url('genre'));
    }

    public function hapus($id)
    {
        $this->genre->delete($id);
        return redirect()->to(base_url('genre'));
    }
}

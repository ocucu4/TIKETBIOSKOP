<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenreModel;
class Genre extends BaseController
{
    protected $genre;

    public function __construct() {
        $this->genre = new GenreModel();
    }

    public function index()
    {
        $data['genre'] = $this->genre->findAll();
        return view('genre/index', $data);
    }

    public function tambah()
    {
        return view('genre/tambah');
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->genre->insert($param);
        return redirect()->to(base_url('genre'));
    }

    public function ubah($id)
    {
        $data['genre'] = $this->genre->find($id);
        return view('genre/ubah', $data);
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->genre->update($id, $param);
        return redirect()->to(base_url('genre'));
    }

    public function delete($id)
    {
        $this->genre->delete($id);
        return redirect()->to(base_url('genre'));
    }
}

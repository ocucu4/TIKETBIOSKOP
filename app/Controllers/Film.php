<?php

namespace App\Controllers;
use App\Models\FilmModel;
class Film extends BaseController
{
    protected $film;
    public function __construct() {
        $this->film = new FilmModel();
    }

    public function index(): string
    {
        $data = $this->film->findAll();
        return view('film/index', ['data' => $data]);
    }

    public function tambah()
    {
        return view('film/tambah');
    }

    public function add()
    {
        $param = $this->request->getPost();
        $this->film->insert($param);
        return redirect()->to(base_url('film'));
    }

    public function ubah()
    {
        return view('film/ubah');
    }

    public function update()
    {
        $param = $this->request->getPost();
        $this->film->insert($param);
        return redirect()->to(base_url('film'));
    }

    public function delete($id)
    {
        $this->film->delete($id);
        return redirect()->to(base_url('film'));
    }
}

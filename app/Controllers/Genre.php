<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenreModel;
use CodeIgniter\HTTP\ResponseInterface;

class Genre extends BaseController
{
    protected $genre;

    public function __construct() {
        $this->genre = new GenreModel();
    }

    public function index()
    {
        $data['genre'] = $this->genre->first();
        return view('genre/index', $data);
    }

    public function tambah()
    {
        



        return view('genre/tambah');
    }
    public function ubah()
    {
        


        return view('genre/ubah');
    }

    public function hapus($id)
    {
        $this->genre->delete($id);
        redirect()->to(base_url('genre/index'));
    }
}

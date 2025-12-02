<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenreModel;

class Genre extends BaseController
{
    protected $genre;

    public function __construct()
    {
        $this->genre = new GenreModel();
    }

    public function index()
    {
        return view('genre/index', [
            'data' => $this->genre->findAll()
        ]);
    }

    public function add()
    {
        $nama = $this->request->getPost('nama_genre');

        if (!$nama) {
            return redirect()->back()->with('error', 'Nama genre wajib diisi');
        }

        $this->genre->insert([
            'nama_genre' => $nama
        ]);

        return redirect()->to(base_url('genre'));
    }

    public function update($id)
    {
        $nama = $this->request->getPost('nama_genre');

        if (!$nama) {
            return redirect()->back()->with('error', 'Nama genre wajib diisi');
        }

        $this->genre->update($id, [
            'nama_genre' => $nama
        ]);

        return redirect()->to(base_url('genre'));
    }

    public function delete($id)
    {
        $this->genre->delete($id);
        return redirect()->to(base_url('genre'));
    }
}

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
        $nama = trim($this->request->getPost('nama_genre'));

        if ($nama === '') {
            return redirect()->back()
                ->with('error', 'Nama genre wajib diisi');
        }

        $cek = $this->genre
            ->where('LOWER(nama_genre)', strtolower($nama))
            ->first();

        if ($cek) {
            return redirect()->to(base_url('genre'))
                ->with('error', 'Genre ini sudah ada dan tidak boleh duplikat');
        }

        try {
            $this->genre->insert([
                'nama_genre' => $nama
            ]);
        } catch (\Throwable $e) {

            return redirect()->to(base_url('genre'))
                ->with('error', 'Genre ini sudah terdaftar');
        }

        return redirect()->to(base_url('genre'))
            ->with('success', 'Genre berhasil ditambahkan');
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

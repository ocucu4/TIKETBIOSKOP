<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;
use App\Models\GenreModel;

class Film extends BaseController
{
    protected $film;
    protected $genre;

    public function __construct()
    {
        $this->film  = new FilmModel();
        $this->genre = new GenreModel();
    }

    public function index()
    {
        $data['data'] = $this->film
            ->select('film.*, genre.nama_genre')
            ->join('genre', 'genre.id_genre = film.id_genre', 'left')
            ->findAll();

        return view('film/index', $data);
    }

    public function tambah()
    {
        $data['genres'] = $this->genre->findAll();
        return view('film/tambah', $data);
    }

    public function add()
    {
        $this->film->insert($this->request->getPost());
        return redirect()->to(base_url('film'))->with('success', 'Film berhasil ditambahkan!');
    }

    public function ubah($id)
    {
        $data['data']   = $this->film->find($id);
        $data['genres'] = $this->genre->findAll();

        return view('film/ubah', $data);
    }

    public function update($id)
    {
        $this->film->update($id, $this->request->getPost());
        return redirect()->to(base_url('film'))->with('success', 'Film berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->film->delete($id);
        return redirect()->to(base_url('film'))->with('success', 'Film berhasil dihapus!');
    }
}

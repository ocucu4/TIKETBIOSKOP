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
        return view('film/index', [
            'data'   => $this->film
                ->select('film.*, genre.nama_genre')
                ->join('genre', 'genre.id_genre = film.id_genre', 'left')
                ->findAll(),
            'genres' => $this->genre->findAll()
        ]);
    }

    public function add()
    {
        $data = [
            'judul_film'       => $this->request->getPost('judul_film'),
            'durasi'           => $this->request->getPost('durasi'),
            'tanggal_mulai'    => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai'  => $this->request->getPost('tanggal_selesai'),
            'sinopsis'         => $this->request->getPost('sinopsis'),
            'harga_tiket'      => $this->request->getPost('harga_tiket'),
            'id_genre'         => $this->request->getPost('id_genre')
        ];

        if (!$data['judul_film'] || !$data['id_genre']) {
            return redirect()->back()->with('error', 'Judul film & genre wajib diisi');
        }

        $this->film->insert($data);
        return redirect()->to(base_url('film'));
    }

    public function update($id)
    {
        $this->film->update($id, [
            'judul_film'      => $this->request->getPost('judul_film'),
            'durasi'          => $this->request->getPost('durasi'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'sinopsis'        => $this->request->getPost('sinopsis'),
            'harga_tiket'     => $this->request->getPost('harga_tiket'),
            'id_genre'        => $this->request->getPost('id_genre')
        ]);

        return redirect()->to(base_url('film'));
    }

    public function delete($id)
    {
        $this->film->delete($id);
        return redirect()->to(base_url('film'));
    }
}

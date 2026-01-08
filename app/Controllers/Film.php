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
        $file = $this->request->getFile('poster');
    $namaPoster = null;

    if ($file && $file->isValid()) {
        $namaPoster = $file->getRandomName();
        $file->move('posterfilm', $namaPoster);
    }

        $data = [
            'judul_film'       => $this->request->getPost('judul_film'),
            'durasi'           => $this->request->getPost('durasi'),
            'sinopsis'         => $this->request->getPost('sinopsis'),
            'harga_tiket'      => $this->request->getPost('harga_tiket'),
            'id_genre'         => $this->request->getPost('id_genre'),
            'poster'           => $namaPoster
        ];

        if (!$data['judul_film'] || !$data['id_genre'] || !$data['harga_tiket']) {
        return redirect()->back()
            ->with('error', 'Semua field wajib diisi');
    }

        $this->film->insert($data);
        return redirect()->to(base_url('film'));
    }

        public function update($id)
    {
        $film = $this->film->find($id);
    
        $file = $this->request->getFile('poster');
        $namaPoster = $film->poster;
    
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaPoster = $file->getRandomName();
            $file->move(ROOTPATH.'public/posterfilm', $namaPoster);
        }
    
        $this->film->update($id, [
            'judul_film'  => $this->request->getPost('judul_film'),
            'durasi'      => $this->request->getPost('durasi'),
            'sinopsis'    => $this->request->getPost('sinopsis'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
            'id_genre'    => $this->request->getPost('id_genre'),
            'poster'      => $namaPoster
        ]);
    
        return redirect()->to(base_url('film'));
    }

    public function delete($id)
    {
        $this->film->delete($id);
        return redirect()->to(base_url('film'));
    }
}

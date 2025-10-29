<?php

namespace App\Controllers;
use App\Models\FilmModel;

class Film extends BaseController
{
    protected $filmModel;

    public function __construct()
    {
        $this->filmModel = new FilmModel();
    }

    // 🔹 tampilkan semua film
    public function index()
    {
        $data['film'] = $this->filmModel->findAll();
        return view('film/index', $data);
    }

    // 🔹 tampilkan form tambah film
    public function create()
    {
        return view('film/form');
    }

    // 🔹 simpan data baru
    public function store()
    {
        $this->filmModel->save([
            'judul_film' => $this->request->getPost('judul_film'),
            'id_genre' => $this->request->getPost('id_genre'),
            'durasi' => $this->request->getPost('durasi'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
        ]);

        return redirect()->to('/film');
    }

    // 🔹 tampilkan form edit
    public function edit($id)
    {
        $data['film'] = $this->filmModel->find($id);
        return view('film/form', $data);
    }

    // 🔹 update data film
    public function update($id)
    {
        $this->filmModel->update($id, [
            'judul_film' => $this->request->getPost('judul_film'),
            'id_genre' => $this->request->getPost('id_genre'),
            'durasi' => $this->request->getPost('durasi'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
        ]);
        return redirect()->to('/film');
    }

    // 🔹 hapus data film
    public function delete($id)
    {
        $this->filmModel->delete($id);
        return redirect()->to('/film');
    }
}

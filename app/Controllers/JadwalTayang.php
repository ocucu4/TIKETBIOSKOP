<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalTayangModel;
use App\Models\FilmModel;

class JadwalTayang extends BaseController
{
    protected $jadwal;
    protected $film;

    public function __construct()
    {
        $this->jadwal = new JadwalTayangModel();
        $this->film   = new FilmModel();
    }

    public function index()
    {
        $data['data'] = $this->jadwal
            ->select('jadwal_tayang.*, film.judul_film')
            ->join('film', 'film.id_film = jadwal_tayang.id_film')
            ->findAll();

        $data['film'] = $this->film->findAll();
        $data['tayang'] = $this->jadwal->findAll();

        return view('jadwaltayang/index', $data);
    }

    public function simpan()
    {
        $this->jadwal->insert($this->request->getPost());
        return redirect()->to(base_url('jadwaltayang'));
    }

    public function update($id)
    {
        $this->jadwal->update($id, $this->request->getPost());
        return redirect()->to(base_url('jadwaltayang'));
    }

    public function delete($id)
    {
        $this->jadwal->delete($id);
        return redirect()->to(base_url('jadwaltayang'));
    }
}

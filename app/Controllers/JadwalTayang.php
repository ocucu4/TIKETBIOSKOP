<?php

namespace App\Controllers;

use App\Models\JadwalTayangModel;

class JadwalTayang extends BaseController
{
    protected $jadwal;

    public function __construct()
    {
        $this->jadwal = new JadwalTayangModel();
    }

    public function index()
    {
        return view("jadwal_tayang/index", [
            'data' => $this->jadwal->findAll()
        ]);
    }

    public function tambah()
    {
        return view("jadwal_tayang/tambah");
    }

    public function simpan()
    {
        $this->jadwal->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/jadwal_tayang')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        return view("jadwal_tayang/edit", [
            'data' => $this->jadwal->find($id)
        ]);
    }

    public function update($id)
    {
        $this->jadwal->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/jadwal_tayang');
    }
}

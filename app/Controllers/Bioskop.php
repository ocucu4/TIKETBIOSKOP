<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BioskopModel;
use CodeIgniter\HTTP\ResponseInterface;

class Bioskop extends BaseController
{
    protected $bioskop;

    public function __construct()
    {
        $this->bioskop = new BioskopModel();
    }

    public function index()
    {
        $data['bioskop'] = $this->bioskop->orderBy('id_bioskop', 'DESC')->findAll();
        return view('bioskop/index', $data);
    }

    public function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'nama_bioskop' => $this->request->getPost('nama_bioskop'),
                'alamat' => $this->request->getPost('alamat'),
                'kota' => $this->request->getPost('kota'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'website' => $this->request->getPost('website'),
                'jam_buka' => $this->request->getPost('jam_buka'),
                'jam_tutup' => $this->request->getPost('jam_tutup'),
            ];

            $this->bioskop->insert($data);
            return redirect()->to(base_url('bioskop'));
        }

        return view('bioskop/tambah');
    }

    public function simpan()
    {
        $data = [
            'nama_bioskop' => $this->request->getPost('nama_bioskop'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'website' => $this->request->getPost('website'),
            'jam_buka' => $this->request->getPost('jam_buka'),
            'jam_tutup' => $this->request->getPost('jam_tutup'),
        ];

        $this->bioskop->insert($data);
        return redirect()->to(base_url('bioskop'));
    }

    public function ubah($id)
    {
        $data['bioskop'] = $this->bioskop->find($id);

        if ($this->request->getMethod() == 'post') {
            $updateData = [
                'nama_bioskop' => $this->request->getPost('nama_bioskop'),
                'alamat' => $this->request->getPost('alamat'),
                'kota' => $this->request->getPost('kota'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'website' => $this->request->getPost('website'),
                'jam_buka' => $this->request->getPost('jam_buka'),
                'jam_tutup' => $this->request->getPost('jam_tutup'),
            ];

            $this->bioskop->update($id, $updateData);
            return redirect()->to(base_url('bioskop'));
        }

        return view('bioskop/ubah', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_bioskop' => $this->request->getPost('nama_bioskop'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'website' => $this->request->getPost('website'),
            'jam_buka' => $this->request->getPost('jam_buka'),
            'jam_tutup' => $this->request->getPost('jam_tutup'),
        ];

        $this->bioskop->update($id, $data);
        return redirect()->to(base_url('bioskop'));
    }

    public function hapus($id)
    {
        $this->bioskop->delete($id);
        return redirect()->to(base_url('bioskop'));
    }
}

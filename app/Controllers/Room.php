<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use App\Models\JadwalTayangModel;
use App\Models\KursiModel;

class Room extends BaseController
{
    protected $room;
    protected $tayang;
    protected $kursi;

    public function __construct() {
        $this->room   = new RoomModel();
        $this->tayang = new JadwalTayangModel();
        $this->kursi = new KursiModel();
        helper('debug');
    }

    public function index()
    {
        $data['data']   = $this->room->findAll();
        $data['tayang'] = $this->tayang->findAll();
        // print_r($data);
        return view('room/index', $data);
    }

    public function tambah()
    {
        $data['tayang'] = $this->tayang->findAll();
        return view('room/tambah', $data);
    }

    public function add()
    {
        $conn = \Config\Database::connect();
        try {
            // $conn->transBegin();
            $param = $this->request->getPost();
            $id_room = $this->room->insert($param, true);
            $kapasitas = $param['kapasitas'];
            $panjang = $param['panjang'];
            $result = [];
            $limit = $kapasitas/$panjang;
            if($limit == 1) $set = "A";
            else if($limit==2) $set = "B";
            else if($limit == 3) $set = "C";
            else if($limit == 4) $set = "D"; 
            else if($limit == 5) $set = "E"; 
            else if($limit == 6) $set = "F"; 
            else if($limit == 7) $set = "G"; 
            for ($i="A";  $i <= $set ; $i++) { 
                for ($j=1; $j<=$panjang ; $j++) { 
                    $item = [
                        'id_room'=>$id_room,
                        'kode_kursi'=>$i.$j,
                        'status'=>"0",
                    ];
                    $result[] = $item;
                }
            }
            $this->kursi->insertBatch($result);
            $conn->transCommit();
            return redirect()->to(base_url('room'));
        } catch (\Throwable $th) {
            $conn->transRollback();
            return redirect()->to(base_url('room'))->with('error', $th->getMessage());
        }

    }

    public function ubah($id)
    {
        $data['data']   = $this->room->find($id);
        $data['tayang'] = $this->tayang->findAll();

        return view('room/ubah', $data);
    }

    public function update($id)
    {
        $param = $this->request->getPost();
        $this->room->update($id, $param);

        return redirect()->to(base_url('room'));
    }

    public function hapus($id)
    {
        $this->room->delete($id);
        return redirect()->to(base_url('room'));
    }
}

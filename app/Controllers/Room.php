<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomModel;
use App\Models\KursiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Room extends BaseController
{
    protected $room;
    protected $kursi;

    public function __construct()
    {
        $this->room  = new RoomModel();
        $this->kursi = new KursiModel();
    }

    /**
     * LIST ROOM + FORM TAMBAH
     */
    public function index()
    {
        return view('room/index', [
            'data' => $this->room->findAll()
        ]);
    }

    /**
     * SIMPAN ROOM + AUTO GENERATE KURSI
     */
    public function add()
    {
        if (!$this->request->is('post')) {
            throw new PageNotFoundException();
        }

        $nama_room = trim($this->request->getPost('nama_room'));
        $kapasitas = (int) $this->request->getPost('kapasitas');
        $panjang   = (int) $this->request->getPost('panjang');

        // VALIDASI AWAL (TIDAK DIUBAH)
        if ($nama_room === '' || $kapasitas <= 0 || $panjang <= 0) {
            return redirect()->back()->with('error', 'Input tidak valid');
        }

        // VALIDASI TAMBAHAN (SATU-SATUNYA PERUBAHAN)
        if ($panjang > $kapasitas) {
            return redirect()->back()
                ->with('error', 'Panjang baris tidak boleh lebih besar dari kapasitas kursi');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // SIMPAN ROOM (LENGKAP)
            $id_room = $this->room->insert([
                'nama_room' => $nama_room,
                'kapasitas' => $kapasitas,
                'panjang'   => $panjang
            ], true);

            if (!$id_room) {
                throw new \RuntimeException('Gagal menyimpan room');
            }

            // GENERATE KURSI (TIDAK DIUBAH)
            $totalBaris = ceil($kapasitas / $panjang);
            $kursiData  = [];

            for ($row = 0; $row < $totalBaris; $row++) {
                $rowLetter = chr(65 + $row); //A, B, C, ....

                for ($col = 1; $col <= $panjang; $col++) {
                    $nomor = ($row * $panjang) + $col;
                    if ($nomor > $kapasitas) break;

                    $kursiData[] = [
                        'id_room'    => $id_room,
                        'kode_kursi' => $rowLetter . $col,
                        'status'     => 0
                    ];
                }
            }

            if (empty($kursiData)) {
                throw new \RuntimeException('Kursi gagal digenerate');
            }

            $this->kursi->insertBatch($kursiData);

            $db->transCommit();
            return redirect()->to(site_url('room'))
                ->with('success', 'Room berhasil ditambahkan');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * HAPUS ROOM + KURSI TERKAIT
     */
    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $this->kursi->where('id_room', $id)->delete();
            $this->room->delete($id);

            $db->transCommit();
            return redirect()->to(site_url('room'))
                ->with('success', 'Room berhasil dihapus');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

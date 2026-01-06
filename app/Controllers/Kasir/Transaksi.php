<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    public function dashboard()
    {
        return view('kasir/dashboard');
    }

    public function pilihJadwal()
    {
        return view('kasir/pilih_jadwal');
    }

    public function pilihKursi($jadwalId)
    {
        return view('kasir/pilih_kursi', [
            'jadwal_id' =>$jadwalId]);
    }

    public function pembayaran()
    {
        return view('kasir/pembayaran');
    }
}


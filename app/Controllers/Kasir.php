<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function dashboard()
    {
        $today = date('Y-m-d');

        $orderHariIni = $this->db->table('order')
            ->where('DATE(tanggal_order)', $today)
            ->countAllResults();

        $berhasil = $this->db->table('order')
            ->where('DATE(tanggal_order)', $today)
            ->where('status_order', 'lunas')
            ->countAllResults();

        $batal = $this->db->table('order')
            ->where('DATE(tanggal_order)', $today)
            ->where('status_order', 'batal')
            ->countAllResults();

        return view('kasir/dashboard', [
            'orderHariIni' => $orderHariIni,
            'berhasil'     => $berhasil,
            'batal'        => $batal,
        ]);
    }

    public function pilihFilm()
    {
        $films = $this->db->table('jadwal_tayang jt')
            ->select('
                jt.id_tayang,
                f.judul_film,
                f.poster,
                jt.tanggal,
                jt.jam_mulai,
                jt.jam_selesai,
                r.nama_room
            ')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
            ->where("
                (jt.tanggal > CURDATE())
                OR (jt.tanggal = CURDATE() AND jt.jam_mulai >= CURTIME())
            ")
            ->orderBy('jt.tanggal', 'ASC')
            ->orderBy('jt.jam_mulai', 'ASC')
            ->get()
            ->getResult();

        return view('kasir/pilih_film', [
            'films' => $films
        ]);
    }

    public function pilihKursi($id_tayang)
    {
        $kursi = $this->db->table('kursi_jadwal_status kjs')
            ->select('k.id_kursi, k.kode_kursi, kjs.status')
            ->join('kursi k', 'k.id_kursi = kjs.id_kursi')
            ->where('kjs.id_tayang', $id_tayang)
            ->orderBy('LEFT(k.kode_kursi,1)', 'ASC', false)
            ->orderBy('CAST(SUBSTRING(k.kode_kursi,2) AS UNSIGNED)', 'ASC', false)
            ->get()
            ->getResult();

        $jadwal = $this->db->table('jadwal_tayang jt')
            ->select('
                f.judul_film,
                jt.tanggal,
                jt.jam_mulai,
                r.nama_room,
                f.harga_tiket
            ')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
            ->where('jt.id_tayang', $id_tayang)
            ->get()
            ->getRow();

        return view('kasir/pilih_kursi', [
            'id_tayang' => $id_tayang,
            'kursi'     => $kursi,
            'jadwal'    => $jadwal,
            'harga'     => $jadwal->harga_tiket
        ]);
    }

    public function konfirmasiPembayaran()
    {
        $id_tayang = $this->request->getPost('id_tayang');
        $kursiRaw  = $this->request->getPost('kursi_terpilih');
        $idKursi = explode(',', $kursiRaw);

        if (!$id_tayang || !$kursiRaw) {
            return redirect()->back()->with('error', 'Kursi belum dipilih');
        }

        $idKursi = explode(',', $kursiRaw);

        $kursiData = $this->db->table('kursi')
            ->select('id_kursi, kode_kursi')
            ->whereIn('id_kursi', $idKursi)
            ->get()
            ->getResult();

        $kodeKursi = array_map(fn($k) => $k->kode_kursi, $kursiData);

        $film = $this->db->table('jadwal_tayang jt')
            ->select('
                f.judul_film,
                jt.tanggal,
                jt.jam_mulai,
                r.nama_room,
                f.harga_tiket
            ')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
            ->where('jt.id_tayang', $id_tayang)
            ->get()
            ->getRow();

        if (!$film) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan');
        }

        return view('kasir/konfirmasi_pembayaran', [
            'film'        => $film,
            'kursiKode'   => $kodeKursi,
            'kursiId'     => $idKursi,
            'total_bayar' => count($idKursi) * $film->harga_tiket,
            'id_tayang'   => $id_tayang
        ]);

    }

    public function prosesPembayaran()
    {  
        $db = \Config\Database::connect();
        $db->transStart();

        $id_tayang    = $this->request->getPost('id_tayang');
        $kursiRaw     = $this->request->getPost('kursi');
        $metode_bayar = $this->request->getPost('metode_bayar');

        if (!$id_tayang || !$kursiRaw || !$metode_bayar) {
            return redirect()->back()->with('error', 'Data tidak lengkap');
        }

        $idKursi = explode(',', $kursiRaw);

        $film = $db->table('jadwal_tayang jt')
            ->select('f.harga_tiket')
            ->join('film f', 'f.id_film = jt.id_film')
            ->where('jt.id_tayang', $id_tayang)
            ->get()
            ->getRow();

        if (!$film) {
            return redirect()->back()->with('error', 'Harga tiket tidak ditemukan');
        }

        $total_bayar = count($idKursi) * $film->harga_tiket;

        $db->table('order')->insert([
            'tanggal_order' => date('Y-m-d H:i:s'),
            'total_bayar'   => $total_bayar,
            'status_order'  => 'pending',
            'id_tayang'     => $id_tayang
        ]);

        $id_order = $db->insertID();

        foreach ($idKursi as $id_kursi) {
            $db->table('detail_order')->insert([
                'id_order' => $id_order,
                'id_kursi' => $id_kursi,
                'harga'    => $film->harga_tiket
            ]);

            $db->table('kursi_jadwal_status')
                ->where('id_tayang', $id_tayang)
                ->where('id_kursi', $id_kursi)
                ->update(['status' => 1]);
        }

        session()->set('metode_bayar_' . $id_order, $metode_bayar);

        $db->transComplete();

        return redirect()->to(base_url('kasir/verifikasi?id_order=' . $id_order));
    }

    public function pembayaranBerhasil()
    {
        $id_order = $this->request->getPost('id_order');

        if (!$id_order) {
            return redirect()->to('kasir/dashboard');
        }

        $metode = session()->get('metode_bayar_' . $id_order);
        if (!$metode) {
            return redirect()->to('kasir/dashboard');
        }

        $order = $this->db->table('order')
            ->where('id_order', $id_order)
            ->get()
            ->getRow();

        if (!$order) {
            return redirect()->to('kasir/dashboard');
        }

        $this->db->table('order')
            ->where('id_order', $id_order)
            ->update(['status_order' => 'lunas']);

        $this->db->table('pembayaran')->insert([
            'id_order'      => $id_order,
            'metode_bayar'  => $metode,
            'jumlah_bayar'  => $order->total_bayar,
            'tanggal_bayar' => date('Y-m-d H:i:s')
        ]);

        session()->remove('metode_bayar_' . $id_order);

        return redirect()->to('kasir/sukses/' . $id_order);
    }
    
    public function pembayaranBatal()
    {
        $id_order = $this->request->getPost('id_order');

        if (!$id_order) {
            return redirect()->to('kasir/dashboard');
        }

        $order = $this->db->table('order')
            ->where('id_order', $id_order)
            ->get()
            ->getRow();

        if (!$order) {
            return redirect()->to('kasir/dashboard');
        }

        $metode = session()->get('metode_bayar_' . $id_order);

        if ($metode) {
            $this->db->table('pembayaran')->insert([
                'id_order'      => $id_order,
                'metode_bayar'  => $metode,
                'jumlah_bayar'  => $order->total_bayar,
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'keterangan'    => 'Dibatalkan'
            ]);
        }

        $detail = $this->db->table('detail_order')
            ->where('id_order', $id_order)
            ->get()
            ->getResult();

        foreach ($detail as $d) {
            $this->db->table('kursi_jadwal_status')
                ->where('id_tayang', $order->id_tayang)
                ->where('id_kursi', $d->id_kursi)
                ->update(['status' => 0]);
        }

        $this->db->table('order')
            ->where('id_order', $id_order)
            ->update(['status_order' => 'batal']);

        session()->remove('metode_bayar_' . $id_order);

        return redirect()->to('kasir/dashboard');
    }

    public function verifikasiPembayaran()
    {
        return view('kasir/verifikasi');
    }

    public function transaksiBerhasil($id_order)
    {

        $order = $this->db->table('order o')
            ->select('
                o.id_order,
                o.total_bayar,
                o.status_order,
                p.metode_bayar,
                jt.tanggal,
                jt.jam_mulai,
                f.judul_film,
                r.nama_room
            ')
            ->join('jadwal_tayang jt', 'jt.id_tayang = o.id_tayang')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
           ->join(
                '(SELECT id_order, metode_bayar 
                  FROM pembayaran 
                  WHERE id_pembayaran IN (
                      SELECT MAX(id_pembayaran) 
                      FROM pembayaran 
                      GROUP BY id_order
                  )
                ) p',
                'p.id_order = o.id_order',
                'left'
            )
            ->where('o.id_order', $id_order)
            ->get()
            ->getRow();

        if (!$order) {
            return redirect()->to('kasir/dashboard')
                ->with('error', 'Order tidak ditemukan');
        }

        $kursi = $this->db->table('detail_order d')
            ->select('k.kode_kursi')
            ->join('kursi k', 'k.id_kursi = d.id_kursi')
            ->where('d.id_order', $id_order)
            ->get()
            ->getResult();

        return view('kasir/sukses', [
            'order' => $order,
            'kursi' => $kursi
        ]);
    }

    public function cetakTiket($id_order)
    {
        
        $order = $this->db->table('order o')
         ->select('
            o.id_order,
            o.tanggal_order,
            o.total_bayar,
            p.metode_bayar,
            jt.tanggal,
            jt.jam_mulai,
            f.judul_film,
            r.nama_room
        ')
        ->join('jadwal_tayang jt', 'jt.id_tayang = o.id_tayang')
        ->join('film f', 'f.id_film = jt.id_film')
        ->join('room r', 'r.id_room = jt.id_room')
        ->join('pembayaran p', 'p.id_order = o.id_order', 'left')
        ->where('o.id_order', $id_order)
        ->get()
        ->getRow();

    if (!$order) {
        return redirect()->to('kasir/dashboard')
            ->with('error', 'Order tidak ditemukan');
    }

    $kursi = $this->db->table('detail_order d')
        ->select('k.kode_kursi')
        ->join('kursi k', 'k.id_kursi = d.id_kursi')
        ->where('d.id_order', $id_order)
        ->get()
        ->getResult();

    return view('kasir/cetak_tiket', [
        'order' => $order,
        'kursi' => $kursi
    ]);
}

    public function riwayat()
    {
        $ordersRaw = $this->db->table('order o')
            ->select('
                o.id_order,
                o.tanggal_order,
                o.total_bayar,
                o.status_order,
                p.metode_bayar,
                jt.tanggal,
                jt.jam_mulai,
                f.judul_film,
                r.nama_room
            ')
            ->join('jadwal_tayang jt', 'jt.id_tayang = o.id_tayang')
            ->join('film f', 'f.id_film = jt.id_film')
            ->join('room r', 'r.id_room = jt.id_room')
            ->join(
                '(SELECT id_order, metode_bayar 
                  FROM pembayaran 
                  WHERE id_pembayaran IN (
                      SELECT MAX(id_pembayaran) 
                      FROM pembayaran 
                      GROUP BY id_order
                  )
                ) p',
                'p.id_order = o.id_order',
                'left'
            )
            ->orderBy('o.tanggal_order', 'DESC')
            ->get()
            ->getResult();
    
        $orders = [];
    
        foreach ($ordersRaw as $o) {
        
            $kursi = $this->db->table('detail_order d')
                ->select('k.kode_kursi')
                ->join('kursi k', 'k.id_kursi = d.id_kursi')
                ->where('d.id_order', $o->id_order)
                ->get()
                ->getResult();
        
            $orders[] = [
                'id'      => $o->id_order,
                'tanggal' => date('d/m/Y', strtotime($o->tanggal_order)),
                'jam'     => date('H:i', strtotime($o->tanggal_order)),
                'film'    => $o->judul_film,
                'room'    => $o->nama_room,
                'kursi'   => array_map(fn($k) => $k->kode_kursi, $kursi),
                'total'   => $o->total_bayar,
                'metode'  => $o->metode_bayar ?? '-',
                'status'  => $o->status_order === 'lunas' ? 'Berhasil' : 'Dibatalkan'
            ];
        }
    
        return view('kasir/riwayat', [
            'orders' => $orders
        ]);
    }

}

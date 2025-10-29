<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $allowedFields = ['nama_pemesan', 'id_film', 'jumlah_tiket', 'total_bayar', 'tanggal_order'];
    protected $useTimestamps = false;
}

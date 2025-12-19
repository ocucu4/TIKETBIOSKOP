<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model

{
    protected $table   = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_order', 
        'metode_bayar', 
        'tanggal_bayar', 
        'jumlah_bayar', 
        'keterangan'
    ];
    
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true; 
    
}
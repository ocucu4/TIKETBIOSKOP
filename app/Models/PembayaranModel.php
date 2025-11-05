<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model

{
    protected $stable   = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $returnType = 'object';
    protected $allowedFields = ['id_order', 'metode_pembayaran', 'status_pembayaran', 'tanggal_pembayaran'];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true; 
    
}
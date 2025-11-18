<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $useTimestamps = false;
    protected $returnType = 'object';
    protected $allowedFields = [
        'nama_pemesan', 
        'status_order',
        'tanggal_order',
        'total_bayar', 
        'id_film',
        'id_room',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    
}

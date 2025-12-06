<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiJadwalStatusModel extends Model
{
    protected $table      = 'kursi_jadwal_status';
    protected $primaryKey = 'id_status';
    protected $returnType = 'object';
    
    protected $allowedFields = [
        'status',
        'id_order',
        'id_kursi'
    ];

    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;
    
}

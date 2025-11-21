<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiJadwalStatusModel extends Model
{
    protected $table      = 'kursi_jadwal_status';
    protected $primaryKey = 'id_status';

    protected $allowedFields = [
        'status',
        'jadwal_tayang_id_tayang',
        'kursi_id_kursi'
    ];

    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;
    
}

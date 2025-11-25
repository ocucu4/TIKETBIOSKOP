<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalTayangModel extends Model
{
    protected $table      = 'jadwal_tayang';
    protected $primaryKey = 'id_tayang';
    protected $returnType = 'object';
    
    protected $allowedFields = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'harga',
        'id_film'
    ];

    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;

}

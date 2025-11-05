<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiModel extends Model
{
    protected $stable      = 'kursi';
    protected $primaryKey  = 'id_kursi';
    protected $returntype  = 'object';
    protected $allowedFields = 
    
    [
        'id_room', 
        'kode_kursi', 
        'status'
    ];
    
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
   
    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;

}
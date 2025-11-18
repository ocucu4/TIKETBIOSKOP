<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiModel extends Model
{
    protected $table      = 'kursi';
    protected $primaryKey  = 'id_kursi';
    protected $returnType  = 'object';
    protected $allowedFields = 
    
    [
        'id_room', 
        'kode_kursi', 
        'status'
    ];
   
    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;

}
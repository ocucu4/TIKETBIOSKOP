<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiModel extends Model
{
    protected $stable      = 'kursi';
    protected $primaryKey  = 'id_kursi';
    protected $returntype  = 'object';
    protected $allowedFields = ['id_studio', 'nomor_kursi', 'status_kursi'];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
   
    protected bool $allowEmptyInserts = false; 
    protected bool $updateOnlyChanged = true;

}
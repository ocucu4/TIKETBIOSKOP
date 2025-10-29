<?php

namespace App\Models;

use CodeIgniter\Model;

class GendreModel extends Model
{
    protected $table            = 'gendre';
    protected $primaryKey       = 'id_gendre';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_gendre'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class BioskopModel extends Model
{
    protected $table            = 'detail_order';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kursi', 'jumlah', 'subtotal'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}

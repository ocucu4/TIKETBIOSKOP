<?php

namespace App\Models;

use CodeIgniter\Model;

class KursiModel extends Model
{
    protected $table         = 'kursi';
    protected $primaryKey    = 'id_kursi';
    protected $returnType    = 'object';

    protected $allowedFields = [
        'kode_kursi',
        'status',
        'id_room'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}

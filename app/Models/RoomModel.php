<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table            = 'room';
    protected $primaryKey       = 'id_room';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_room',
        'kapasitas',
        'id_tayang'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}

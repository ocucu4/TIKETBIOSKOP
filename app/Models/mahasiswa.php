<?php

namespace App\Models;

use CodeIgniter\Model;

class BioskopModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id_mahasiswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_mahasiswa'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}

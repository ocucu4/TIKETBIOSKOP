<?php

namespace App\Models;

use CodeIgniter\Model;

class BioskopModel extends Model
{
    protected $table            = 'bioskop';
    protected $primaryKey       = 'id_bioskop';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_bioskop', 'alamat', 'kota', 'telepon', 'email', 'website', 'jam_buka', 'jam_tutup'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}

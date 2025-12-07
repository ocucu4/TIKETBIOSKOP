<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{
    protected $table = 'film';
    protected $primaryKey = 'id_film';
    protected $returnType = 'object';
    protected $allowedFields = [
        'judul_film',
        'id_genre',
        'durasi',
        'sinopsis',
        'harga_tiket'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}

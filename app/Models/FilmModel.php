<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{
    protected $table = 'film';
    protected $primaryKey = 'id_film';
    protected $allowedFields = [
        'judul_film',
        'id_genre',
        'durasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'sinopsis',
        'harga_tiket'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}

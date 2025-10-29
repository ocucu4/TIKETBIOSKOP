<?php

namespace App\Controllers;
use App\Models\FilmModel;

class Home extends BaseController
{
    public function index()
    {
        $filmModel = new FilmModel();
        $data['film'] = $filmModel->findAll();
        return view('home', $data);
    }
}

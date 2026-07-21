<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class EvidenciaController extends Controller
{
    public function index()
    {
        return view('evidencias.index');
    }
}
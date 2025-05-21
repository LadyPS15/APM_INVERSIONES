<?php

namespace App\Http\Controllers;
use App\Models\Career;

use Illuminate\Http\Request;

class CareersController extends Controller
{
     public function create()
{
    $careers = Career::all();
    dd($careers); // Esto mostrará las carreras cargadas para verificar
    return view('form.formulario', compact('careers'));
}

}

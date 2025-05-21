<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgrammingLanguage;

class ProgrammingLanguageController extends Controller
{
     public function index()
    {
        // Aquí no quiero que liste los datos de la tabla, solo que se use los
        // datos de la tabla para el formulario
        //$languages = ProgrammingLanguage::all();
        //return view('programming_languages.index', compact('languages')); // vista para mostrar lenguajes
    }
}

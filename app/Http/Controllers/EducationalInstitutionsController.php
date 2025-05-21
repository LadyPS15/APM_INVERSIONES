<?php

namespace App\Http\Controllers;
use App\Models\EducationalInstitution;

use Illuminate\Http\Request;

class EducationalInstitutionController extends Controller
{
    public function index()
    {
        // Aqui no quiero que liste los datos de la tabla solo que se use los
        // datos de la tabla para el formulario
        //$institutions = EducationalInstitution::all();
        //return view('institutions.index', compact('institutions')); 
    }
}

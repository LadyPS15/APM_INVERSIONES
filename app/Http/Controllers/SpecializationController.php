<?php

namespace App\Http\Controllers;
use App\Models\Specialization;

use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
{
    // Aquí no quiero que liste los datos de la tabla, solo que se use los
    // datos de la tabla para el formulario
    //$specializations = Specialization::all();
    //return view('specializations.index', compact('specializations'));
}

}

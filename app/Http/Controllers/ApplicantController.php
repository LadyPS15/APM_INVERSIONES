<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Careers;

class ApplicantController extends Controller
{
    public function create()
    {
        // Puedes pasar las carreras para llenar el select (opcional)
        $careers = Careers::all();

        return view('form.formulario', compact('careers')); // tu vista HTML
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'email' => 'required|email|unique:applicants,email',
            'carrera' => 'required|string|max:100',
            'ciclo' => 'required|integer|between:1,10',
        ]);

        $applicant = new Applicant();
        $applicant->full_name = $request->input('nombres');
        $applicant->email = $request->input('email');
        $applicant->access_token = uniqid('token_', true); // genera token único

        // Guardar info adicional (puedes agregar columnas a la tabla applicants si quieres guardar carrera y ciclo ahí,
        // o bien relacionarlo con la tabla careers si quieres que sea FK)
        // Para simplificar, supongamos que los guardas en applicants (debes migrar para agregar estos campos)
        $applicant->career = $request->input('carrera');  // Aquí suponiendo que creaste campo 'career' en applicants
        $applicant->academic_cycle = $request->input('ciclo'); // idem

        $applicant->save();

        // Redirigir al formulario técnico
        return redirect()->route('form.formulario_tecnico', ['applicant_id' => $applicant->id]);
    }
}
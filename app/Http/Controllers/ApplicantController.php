<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class ApplicantController extends Controller
{
    public function create()
    {
        return view('form.formulario'); // tu vista HTML
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'email' => 'required|email|unique:applicants,email',
        ]);

        $applicant = new Applicant();
        $applicant->full_name = $request->input('nombres');
        $applicant->email = $request->input('email');
        $applicant->access_token = uniqid('token_', true); // genera token único
        $applicant->save();

        return redirect()->back()->with('success', '¡Registro exitoso!');
    }
}

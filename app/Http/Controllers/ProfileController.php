<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.perfil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // password + password_confirmation
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        // $user = Auth::user();
        // $user->name = $request->name;

        // if ($request->password) {
        //     $user->password = Hash::make($request->password);
        // }

        // $user->save();

        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
    }

    // public function perfilPracticante()
    // {
    //     $user = Auth::user();
    //     return view('practicante.perfil', compact('user'));
    // }
    public function perfilPracticante()
    {
        $user = Auth::user(); // Obtiene el usuario logueado

        // Busca en la tabla 'applicants' usando el email del usuario
        $applicant = Applicant::where('email', $user->email)->first();

        // Pasa ambos datos a la vista
        return view('practicante.perfil', [
            'user' => $user,
            'applicant' => $applicant, // Datos del aplicante
        ]);
    }
}
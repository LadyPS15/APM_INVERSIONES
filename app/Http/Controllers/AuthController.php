<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Muestra la vista donde está el formulario de login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Verifica si el usuario existe
        $user = User::where('email', $request->email)->first();

        // Si el usuario no existe, muestra un error
        if (!$user) {
            return back()->withErrors(['email' => 'Correo electrónico no encontrado.']);
        }

        // Verifica si la contraseña coincide
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('reclutador.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }
}

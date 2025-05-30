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

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     // Verifica si el usuario existe
    //     $user = User::where('email', $request->email)->first();

    //     // Si el usuario no existe, muestra un error
    //     if (!$user) {
    //         return back()->withErrors(['email' => 'Correo electrónico no encontrado.']);
    //     }

    //     // Verifica si la contraseña coincide
    //     if (Hash::check($request->password, $user->password)) {
    //         Auth::login($user);
    //         return redirect()->route('reclutador.dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    // }

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

            // Redirige según el rol del usuario
            if ($user->role === 'admin' || $user->role === 'recruiter') {
                return redirect()->route('reclutador.dashboard');
            } elseif ($user->role === 'Scrum Master') {
                return redirect()->route('practicante.dashboard');
            }

            // Si el rol no coincide con ninguno esperado
            Auth::logout(); // Cerramos la sesión que acabamos de abrir
            return back()->withErrors([
                'email' => 'Tu rol no tiene asignado un dashboard. Por favor, contacta al administrador.'
            ]);
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
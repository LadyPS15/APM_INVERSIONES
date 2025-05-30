<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        // Filtrar solo usuarios con rol Scrum Master
        $users = User::where('role', 'Scrum Master')->get();

        // Para cada usuario, buscamos el nombre del applicant (asumiendo que hay relación por email o nombre)
        foreach ($users as $user) {
            // Buscar Applicant por email (o ajusta si el match es por otro campo)
            $applicant = Applicant::where('email', $user->email)->first();

            if ($applicant) {
                $nombreCompleto = explode(' ', $applicant->full_name);

                $nombre     = isset($nombreCompleto[0]) ? substr($nombreCompleto[0], 0, 2) : 'no';
                $apellido1  = isset($nombreCompleto[1]) ? substr($nombreCompleto[1], 0, 2) : 'ap';
                $apellido2  = isset($nombreCompleto[2]) ? substr($nombreCompleto[2], 0, 2) : 'am';

                $user->contraseña = strtolower($nombre . $apellido1 . $apellido2);
            } else {
                $user->contraseña = 'no_def';
            }
        }

        return view('reclutador.credenciales', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::check() && Auth::user()->id === $user->id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}
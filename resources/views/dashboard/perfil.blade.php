@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    @vite('resources/css/dashboard.css')
</head>
<style>
    /* .profile-form-wrapper {
        background: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        max-width: 500px;
        width: 100%;
    } */

    .content h3 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .content form {
        background: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        max-width: 500px;
        margin: 0% auto;
    }

    .content label {
        display: block;
        font-weight: bold;
        margin-top: 1rem;
        color: #555;
    }

    .content input[type="text"],
    .content input[type="email"],
    .content input[type="password"] {
        width: 90%;
        padding: 0.6rem 1rem;
        margin-top: 0.3rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.2s;
    }

    .content input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .btn.btn-blue {
        background-color: #007bff;
        color: white;
        padding: 0.6rem 1.5rem;
        border: none;
        border-radius: 8px;
        margin-top: 1.5rem;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s ease;
    }

    .btn.btn-blue:hover {
        background-color: #0056b3;
    }

    .content div[style*="color: green"] {
        margin-bottom: 1rem;
        font-weight: bold;
        color: #28a745;
    }
</style>

<body>
    <div class="sidebar">
        <h2>APM Inversiones ERL</h2>
        <div class="sidebar-links">
            <a href="{{ route('reclutador.dashboard') }}">Resultados</a>
            <a href="{{ route('reclutador.credenciales') }}">Credenciales</a>
            <a href="{{ route('perfil.show') }}">Mi Perfil</a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </div>

    <div class="topbar">
        {{ Auth::user()->name }}&nbsp;&nbsp;
        <div class="user-circle">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

    <div class="content">
        <h3>Mi Perfil</h3>

        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('perfil.update') }}">
            @csrf

            <label>Nombre:</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required disabled><br><br>

            <label>Email:</label><br>
            <input type="email" value="{{ $user->email }}" disabled><br><br>

            <label>Rol:</label><br>
            <input type="text" value="{{ $user->role }}" disabled><br><br>

            {{-- <label>Nueva Contraseña:</label><br>
            <input type="password" name="password"><br>

            <label>Confirmar Contraseña:</label><br>
            <input type="password" name="password_confirmation"><br><br> --}}

            {{-- <button type="submit" class="btn btn-blue">Actualizar Perfil</button> --}}
        </form>
    </div>
</body>

</html>

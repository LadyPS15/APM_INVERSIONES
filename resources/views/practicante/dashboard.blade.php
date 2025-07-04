@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Practicantes</title>
    @vite('resources/css/dashboard.css')
</head>

<body>
    <div class="sidebar">
        <h2>APM Inversiones ERL</h2>
        <div class="sidebar-links">
            <a href="{{ route('practicante.dashboard') }}">Dashboard</a>
            <a href="{{ route('practicante.recursoscrum') }}">Recursos Scrum</a>
            <a href="{{ route('practicante.comunidad') }}">comunidad</a>
            <a href="{{ route('practicante.perfil') }}">Mi Perfil</a>
        </div>
        <!-- Botón de logout mejorado -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </div>
    <div class="topbar">
        {{-- Mostrar el nombre del usuario autenticado --}}
        {{-- y una inicial dentro de un círculo --}}
        {{ Auth::user()->name }}&nbsp;&nbsp;
        <div class="user-circle">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
    <div class="content">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h3>¡Recursos para Scrum Master!</h3>
        <br><br>
        <h3>Documentación</h3>
        <p>Descarga recursos utiles para tu rol de Scrum Master</p>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Acceso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tdtext">La Guía Definitiva de Scrum: Las Reglas del Juego
                        <small>La guia definitiva de Scum por Schwaber y Stherland </small>
                    </td>
                    <td>
                        {{-- <a href="https://www.scrum.org/resources/scrum-guide" target="_blank" style="cursor: pointer">
                            Descargar PDF
                        </a> --}}
                        {{-- Asume que el PDF está en storage/app/public/recursos_scrum/La_Guia_Definitiva_de_Scrum.pdf --}}
                        <a href="{{ asset('storage/recursos_scrum/La_Guia_Definitiva_de_Scrum.pdf') }}"
                            download="La_Guia_Definitiva_de_Scrum.pdf" style="cursor: pointer">
                            Descargar PDF
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Guia Scrum 2024 European Scrum
                        <small>La guia definitiva de Scum por Schwaber y Stherland </small>
                    </td>
                    <td>
                        <a href="{{ asset('storage/recursos_scrum/La_Guia_Definitiva_de_Scrum.pdf') }}"
                            download="La_Guia_Definitiva_de_Scrum.pdf" style="cursor: pointer">
                            Descargar PDF
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Guia - Profesional Scrum Master
                        <small>Guia especifica para Scrum Masters</small>
                    </td>
                    <td>
                        <a href="{{ asset('storage/recursos_scrum/La_Guia_Definitiva_de_Scrum.pdf') }}"
                            download="La_Guia_Definitiva_de_Scrum.pdf" style="cursor: pointer">
                            Descargar PDF
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Scrum Master de Scrum Manager
                        <small>Conjunto de plantillas para facilitar las reuniones</small>
                    </td>
                    <td>
                        <a href="{{ asset('storage/recursos_scrum/La_Guia_Definitiva_de_Scrum.pdf') }}"
                            download="La_Guia_Definitiva_de_Scrum.pdf" style="cursor: pointer">
                            Descargar PDF
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>

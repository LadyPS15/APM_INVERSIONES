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
        <h3>¡Listado de Cursos!</h3>
        <table>
            <thead>
                <tr>
                    <th>Cursos</th>
                    <th>Acceso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Accede a nuetros cursos especializados para Scrum Master
                    </td>
                    <td>
                        <a href="https://www.scrum.org/resources/scrum-guide" target="_blank" style="cursor: pointer">
                            Accesder al Curso
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Accede a nuetros cursos especializados para Scrum Master
                    </td>
                    <td>
                        <a href="https://www.scrum.org/resources/scrum-guide" target="_blank" style="cursor: pointer">
                            Accesder al Curso
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Accede a nuetros cursos especializados para Scrum Master
                    </td>
                    <td>
                        <a href="https://www.scrum.org/resources/scrum-guide" target="_blank" style="cursor: pointer">
                            Accesder al Curso
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Accede a nuetros cursos especializados para Scrum Master
                    </td>
                    <td>
                        <a href="https://www.scrum.org/resources/scrum-guide" target="_blank" style="cursor: pointer">
                            Accesder al Curso
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

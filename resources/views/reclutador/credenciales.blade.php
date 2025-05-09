@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credenciales de Usuarios</title>
    @vite('resources/css/dashboard.css')
</head>
<body>
    <div class="sidebar">
        <h2>APM Inversiones ERL</h2>
        <a href="{{ route('reclutador.dashboard') }}">Resultados</a>
        <a href="#">Credenciales</a>
        <a href="#">Mi Perfil</a>
    </div>

    <div class="topbar">
    {{ Auth::user()->name }}&nbsp;&nbsp;
    <div class="user-circle">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

    <div class="content">
        <h3>Lista de Usuarios</h3>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-red">Eliminar</button></td>
                </tr>
                
            </tbody>
        </table>
    </div>
</body>
</html>

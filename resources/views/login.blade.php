<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - APM INVERSIONES ERL</title>
    @vite('resources/css/login.css')
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Iniciar Sesion</h2>
            <div class="divider"></div>

            <!-- Muestra los errores globales -->
            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Campo de email -->
                <div>
                    <label for="email">Correo Electronico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo de contraseña -->
                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón de inicio de sesión -->
                <div>
                    <button type="submit">Iniciar Sesion</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Practicante - Información personal</title>
    @vite('resources/css/form.css')
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="section-title">Información Personal</h2>
            <form method="POST" action="{{ route('form.formulario.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="nombres">Apellidos y Nombres</label>
                    <input type="text" id="nombres" name="nombres" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="carrera">Carrera Profesional</label>
                    <select id="carrera" name="carrera" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach($careers as $career)
                            <option value="{{ $career->id }}">{{ $career->name }}</option> <!-- Usamos el ID aquí -->
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="ciclo">Ciclo Académico</label>
                    <select id="ciclo" name="ciclo" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Primer ciclo</option>
                        <option value="2">Segundo ciclo</option>
                        <option value="3">Tercer ciclo</option>
                        <option value="4">Cuarto ciclo</option>
                        <option value="5">Quinto ciclo</option>
                        <option value="6">Sexto ciclo</option>
                    </select>
                </div>
                
                <div class="button-container">
                    <a href="#" class="btn">Atrás</a>
                    <button type="submit" class="btn">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

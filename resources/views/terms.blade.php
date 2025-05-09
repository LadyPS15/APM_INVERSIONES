 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones</title>
    @vite('resources/css/terms.css')

    </head>
<body>
    <br><br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="header">
            TÉRMINOS Y CONDICIONES PARA LA SOLICITUD DE PRACTICANTES
        </div>
        
        <div class="content">
            <p>
                Las prácticas están dirigidas a estudiantes de instituciones con las que exista
                un convenio mutuo de cooperación. Este convenio permite que los alumnos
                complementen su formación académica mediante experiencias laborales
                supervisadas, garantizando el cumplimiento de los objetivos educativos y
                profesionales acordados.
            </p>
            
            <p>
                El estudiante deberá cumplir con los horarios establecidos y mantener una
                conducta profesional durante todo el período de prácticas.
            </p>
            
            <p>
                La empresa se reserva el derecho de terminar las prácticas si el estudiante no
                cumple con los estándares de rendimiento esperados.
            </p>
            
            <div class="button-container">
                <form method="GET" action="{{ route('form.formulario') }}">
                    @csrf
                    <button type="submit" class="button accept-button">Aceptar</button>
                </form>
                
                <form method="GET" action="{{ route('index') }}">
                    <button type="submit" class="button cancel-button">Salir</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
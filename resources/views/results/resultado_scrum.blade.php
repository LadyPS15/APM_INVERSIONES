<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evaluación Completada</title>
      @vite('resources/css/resultados.css')
</head>
<body>
    <div class="container">
        <h1>¡Evaluación Completada!</h1>
        <p class="subtitle">Aquí están los resultados de tu evaluación</p>

        <div class="profile-info">
            <p><strong>Nombre:</strong> {{ $applicant->full_name }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $applicant->email }}</p>
            <p><strong>Carrera:</strong> {{ $applicant->career->name }}</p>
            <p><strong>Ciclo Académico:</strong> {{ $applicant->academic_cycle }}</p>
            <p><strong>Especialización:</strong> {{ optional($applicant->specialization)->name }}</p>
            <p><strong>Lenguajes de Programación:</strong> {{ $applicant->programming_languages }}</p>
            <p><strong>Disponibilidad:</strong> {{ $applicant->availability }}</p>
        </div>

        <div class="score-section">
            <div class="section-title">Puntuación General como Practicante</div>
            <p>Puntaje Total: <span>{{ $scrum_score }} / 10.0</span> 
                @if ($scrum_score >= 8)
                    (Excelente)
                @elseif ($scrum_score >= 6)
                    (Muy Bueno)
                @elseif ($scrum_score >= 4)
                    (Bueno)
                @else
                    (Regular)
                @endif
            </p>

            <div class="role-box">
                Asignación de Rol: {{ $applicant->rol_principal ?? 'No asignado' }}
            </div>
        </div>
        <div class="footer">
            <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
    </body>
</html>
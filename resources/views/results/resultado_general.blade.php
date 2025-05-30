<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Evaluación Completada</title>
    @vite('resources/css/resultalgen.css')
</head>

<body>
    <div class="container">
        <h1>¡Evaluación Completada!</h1>
        <p class="subtitle">Aquí están los resultados de tu evaluación</p>
        <hr>

        <div class="section-title">Resumen del Perfil</div>

        <p class="parrafo">Gracias por tu interés. No has tenido experiencia en metodologías Scrum, por lo que no se
            realizará
            evaluación.</p>

        <div class="profile-info">
            <p><strong>Nombre:</strong> <span> {{ $applicant->full_name }}</span></p>
            <p><strong>Correo Electrónico:</strong> <span>{{ $applicant->email }}</span></p>
            <p><strong>Carrera:</strong> <span>{{ $applicant->career->name }}</span></p>
            <p><strong>Ciclo Académico:</strong> <span>{{ $applicant->academic_cycle }} Semestre</span></p>
            <p><strong>Área de Enfoque:</strong>
                <span>{{ optional($applicant->specialization)->name ?? $applicant->other_specialization }}</span>
            </p>
            <p><strong>Lenguajes de Programación:</strong>
                <span>{{ $applicant->programming_languages }},{{ $applicant->otros_lenguajes }}</span></p>
            <p><strong>Disponibilidad Horaria:</strong> <span>{{ $applicant->availability }}</span></p>
        </div>
        <div class="score-section">
            <div class="section-title">Puntuación General como Practicante</div>
            <p>Puntaje Total: <span>{{ $total_score }}/10.0</span>
                @if ($total_score >= 8)
                    (Excelente)
                @elseif ($total_score >= 6)
                    (Muy Bueno)
                @elseif ($total_score >= 4)
                    (Bueno)
                @else
                    (Regular)
                @endif
            </p>
        </div>
        <div class="footer">
            <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
</body>

</html>

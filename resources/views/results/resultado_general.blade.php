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

        <h1>Resultado General</h1>

        <p>Gracias por tu interés. No has tenido experiencia en metodologías Scrum, por lo que no se realizará evaluación.</p>

        <p><strong>Nombre:</strong> {{ $applicant->full_name }}</p>
        <p><strong>Correo:</strong> {{ $applicant->email }}</p>
        <p><strong>Carrera:</strong> {{ $applicant->career->name }}</p>
        <p><strong>Ciclo:</strong> {{ $applicant->academic_cycle }}</p>
        <p><strong>Área de Enfoque:</strong> {{ optional($applicant->specialization)->name }}</p>
        <p><strong>Lenguajes de Programación:</strong> {{ $applicant->programming_languages }}</p>
        <p><strong>Disponibilidad Horaria:</strong> {{ $applicant->availability }}</p>

        <h2>Puntaje general como practicante:</h2>
            <p>Puntaje Total: {{ $total_score }}/10.0
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
        <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
        </div>
</body>
</html>

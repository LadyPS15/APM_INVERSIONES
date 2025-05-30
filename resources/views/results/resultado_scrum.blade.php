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
        <hr>
        <div class="section-title">Resumen del Perfil</div>
        <div class="profile-info">
            <p><strong>Nombre:</strong> <span> {{ $applicant->full_name }}</span></p>
            <p><strong>Correo Electrónico:</strong> <span>{{ $applicant->email }}</span></p>
            <p><strong>Carrera:</strong> <span>{{ $applicant->career->name }}</span></p>
            <p><strong>Ciclo Académico:</strong> <span>{{ $applicant->academic_cycle }} Semestre</span></p>
            <p><strong>Especialización:</strong>
                <span>{{ optional($applicant->specialization)->name ?? $applicant->other_specialization }}</span>
            </p>
            <p><strong>Lenguajes de Programación:</strong>
                <span>{{ $applicant->programming_languages }},{{ $applicant->otros_lenguajes }}</span></p>
            <p><strong>Disponibilidad:</strong> <span>{{ $applicant->availability }}</span></p>
        </div>

        <div class="score-section">
            <div class="section-title">Puntuación General como Practicante</div>
            <p>Puntaje Total: <span>{{ $applicant->scrum_score }} / 5.0</span>
                @if ($scrum_score >= 4.0)
                    (Muy Bueno)
                @elseif ($scrum_score >= 2.0)
                    (Bueno)
                @else
                    (Regular)
                @endif
            </p>

            <div class="role-box">
                Asignación de Rol: {{ $applicant->rol_principal ?? 'No asignado' }}
            </div>
            @if ($applicant->scrumEvaluation)
                <p class="scrum-evaluation-score">Puntaje de Evaluación Scrum:
                    {{ $applicant->scrumEvaluation->score }}/10 puntos</p>
            @else
                <p class="scrum-evaluation-score">Puntaje de Evaluación Scrum: No evaluado</p>
            @endif
        </div>
        <div class="footer">
            <p>Fecha de evaluación: {{ $applicant->created_at->format('d/m/Y') }}</p>
        </div>
</body>

</html>

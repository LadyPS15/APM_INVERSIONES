<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APM INVERSIONES - Evaluación</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/eva_oficial.css')
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Evaluacion de Scrum</h1>

            <form method="POST" action="{{ route('evaluacion.guardar2', ['applicant' => $applicant->id]) }}">
                @csrf
                <!-- Pregunta 7 -->
                <div class="question">
                    <h3>¿Alguna vez lideraste un equipo en un proyecto académico o personal? Describe tu experiencia.</h3>
                    <div class="text-input-group">
                        <textarea name="p7" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 8 -->
                <div class="question">
                    <h3>¿Qué decisiones importantes has tenido que tomar en un proyecto y cómo llegaste a ellas?</h3>
                    <div class="text-input-group">
                        <textarea name="p8" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 9 -->
                <div class="question">
                    <h3>¿Cómo motivas a otros cuando el equipo está desanimado o bloqueado?</h3>
                    <div class="text-input-group">
                        <textarea name="p9" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 10 -->
                <div class="question">
                    <h3>¿Has participado en alguna reunión diaria (Daily Scrum)? Si es así, ¿qué aportabas normalmente?</h3>
                    <div class="text-input-group">
                        <textarea name="p10" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 11 -->
                <div class="question">
                    <h3>Describe tu experiencia, si la tienes, trabajando bajo metodologías ágiles. ¿Qué aprendiste de ese enfoque?</h3>
                    <div class="text-input-group">
                        <textarea name="p11" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>
                <!-- Pregunta 12 -->
                <div class="question">
                    <h3>¿Qué tipo de tareas te asignaban normalmente en proyectos anteriores y cómo las gestionabas?</h3>
                    <div class="text-input-group">
                        <textarea name="p12" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <div class="buttons-container">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Atrás</button>
                    <button type="submit" class="btn btn-primary">Finalizar Evaluación</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>

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
            <form method="POST" action="{{ route('evaluacion.guardar', ['applicant' => $applicant->id]) }}">
                @csrf
                <!-- Pregunta 1 -->
                <div class="question">
                    <h3>¿Cómo te aseguras de que tus ideas sean comprendidas por todos los miembros del equipo?</h3>
                    <div class="text-input-group">
                        <textarea name="p1" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="question">
                    <h3>Describe una situación en la que tuviste que explicar un concepto técnico a alguien sin conocimientos técnicos. ¿Cómo lo hiciste?</h3>
                    <div class="text-input-group">
                        <textarea name="p2" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="question">
                    <h3>¿Cómo reaccionas cuando alguien no está de acuerdo contigo en una reunión de equipo?
                    </h3>
                    <div class="text-input-group">
                        <textarea name="p3" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="question">
                    <h3>Cuéntanos sobre una experiencia en la que trabajaste en equipo ¿Qué rol desempeñaste y cómo contribuiste al éxito del grupo?</h3>
                    <div class="text-input-group">
                        <textarea name="p4" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="question">
                    <h3>¿Cómo manejas los conflictos dentro de un equipo?</h3>
                    <div class="text-input-group">
                        <textarea name="p5" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>
                
                <!-- Pregunta 6 -->
                <div class="question">
                    <h3>¿Qué estrategias usas para colaborar efectivamente con compañeros que piensan diferente a ti?
                    </h3>
                    <div class="text-input-group">
                        <textarea name="p6" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                    </div>
                </div>
                <div class="buttons-container">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Atrás</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

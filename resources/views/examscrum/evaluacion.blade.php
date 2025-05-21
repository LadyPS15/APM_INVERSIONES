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
                    <h3>¿Cómo te aseguras de que el equipo se mantenga enfocado en los objetivos?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p1[]" value="1" id="p1-1">
                            <label for="p1-1">Confío en que cada uno haga su parte.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p1[]" value="2" id="p1-2">
                            <label for="p1-2">Recuerdo los objetivos en las reuniones cuando es necesario.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p1[]" value="3" id="p1-3">
                            <label for="p1-3">Mantengo la visibilidad de los objetivos y ayudo a eliminar distracciones.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="question">
                    <h3>¿Cómo reaccionas ante cambios inesperados en los requisitos del producto?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p2[]" value="1" id="p2-1">
                            <label for="p2-1">Prefiero seguir el plan original sin cambios.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p2[]" value="2" id="p2-2">
                            <label for="p2-2">Evalúo el impacto del cambio antes de aceptarlo.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p2[]" value="3" id="p2-3">
                            <label for="p2-3">Facilito la adaptación y ayudo a priorizar según el valor del negocio.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="question">
                    <h3>¿Cómo manejas conflictos dentro del equipo?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p3[]" value="1" id="p3-1">
                            <label for="p3-1">Evito involucrarme y me concentro en mi trabajo.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p3[]" value="2" id="p3-2">
                            <label for="p3-2">Intervengo solo cuando me afecta directamente.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p3[]" value="3" id="p3-3">
                            <label for="p3-3">Facilito conversaciones para encontrar soluciones colaborativas.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="question">
                    <h3>¿Cómo manejas reuniones de equipo?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p4[]" value="1" id="p4-1">
                            <label for="p4-1">Prefiero que alguien más las lidere y participo solo cuando sea necesario.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p4[]" value="2" id="p4-2">
                            <label for="p4-2">Contribuyo activamente cuando es necesario.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p4[]" value="3" id="p4-3">
                            <label for="p4-3">Mantengo comunicación constante y transparente con ellos.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="question">
                    <h3>¿Cómo actúas cuando el equipo está bajo presión o enfrenta desafíos?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p5[]" value="1" id="p5-1">
                            <label for="p5-1">Me concentro en mis tareas y dejo que otros manejen la situación.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p5[]" value="2" id="p5-2">
                            <label for="p5-2">Intento mantener la calma y apoyar al equipo en lo que pueda.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p5[]" value="3" id="p5-3">
                            <label for="p5-3">Ayudo al equipo a manejar la presión, negociando expectativas y evitando interrupciones.</label>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary" onclick="history.back()">Atrás</button>
                <button type="submit" class="btn btn-primary">Continuar</button>

            </form>
        </div>
    </div>
</body>
</html>


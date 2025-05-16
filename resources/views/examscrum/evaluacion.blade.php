<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APM INVERSIONES - Evaluación</title>
    @vite('resources/css/evaluacion.css')
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Evaluacion de Scrum</h1>

            <form>
                <!-- Pregunta 1 -->
                <div class="question">
                    <h3>¿Cómo te aseguras de que el equipo se mantenga enfocado en los objetivos?</h3>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p1[]" value="1"> Confío en que cada uno haga su parte.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p1[]" value="2"> Recuerdo los objetivos en las reuniones cuando es necesario.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p1[]" value="3"> Mantengo la visibilidad de los objetivos y ayudo a eliminar distracciones.</label>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="question">
                    <h3>¿Cómo reaccionas ante cambios inesperados en los requisitos del producto?</h3>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p2[]" value="1"> Prefiero seguir el plan original sin cambios.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p2[]" value="2"> Evalúo el impacto del cambio antes de aceptarlo.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p2[]" value="3"> Facilito la adaptación y ayudo a priorizar según el valor del negocio.</label>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="question">
                    <h3>¿Cómo manejas conflictos dentro del equipo?</h3>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p3[]" value="1"> Evito involucrarme y me concentro en mi trabajo.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p3[]" value="2"> Intervengo solo cuando me afecta directamente.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p3[]" value="3"> Facilito conversaciones para encontrar soluciones colaborativas.</label>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="question">
                    <h3>¿Cómo manejas reuniones de equipo?</h3>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p4[]" value="1"> Prefiero que alguien más las lidere y participo solo cuando sea necesario.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p4[]" value="2"> Contribuyo activamente cuando es necesario.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p4[]" value="3"> Mantengo comunicación constante y transparente con ellos.</label>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="question">
                    <h3>¿Cómo actúas cuando el equipo está bajo presión o enfrenta desafíos?</h3>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p5[]" value="1"> Me concentro en mis tareas y dejo que otros manejen la situación.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p5[]" value="2"> Intento mantener la calma y apoyar al equipo en lo que pueda.</label>
                    </div>
                    <div class="checkbox-option">
                        <label><input type="checkbox" name="p5[]" value="3"> Ayudo al equipo a manejar la presión, negociando expectativas y evitando interrupciones.</label>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Atrás</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/evaluacion-parte2'">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


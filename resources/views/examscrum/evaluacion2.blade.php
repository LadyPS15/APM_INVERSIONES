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

            <form>
                <!-- Pregunta 6 -->
                <div class="question">
                    <h3>¿Qué haces cuando alguien del equipo tiene dificultades con su trabajo?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p6[]" value="1" id="p6-1">
                            <label for="p6-1">Dejo que lo resuelva por su cuenta.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p6[]" value="2" id="p6-2">
                            <label for="p6-2">Ayudo si me lo piden.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p6[]" value="3" id="p6-3">
                            <label for="p6-3">Identifico oportunidades para apoyar y fomentar un ambiente de aprendizaje.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 7 -->
                <div class="question">
                    <h3>¿Cómo te aseguras de que el trabajo del equipo aporte valor al cliente?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p7[]" value="1" id="p7-1">
                            <label for="p7-1">Me enfoco en completar mis tareas sin cuestionar su impacto.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p7[]" value="2" id="p7-2">
                            <label for="p7-2">Propongo mejores técnicas cuando es posible.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p7[]" value="3" id="p7-3">
                            <label for="p7-3">Facilito la colaboración entre el equipo y el Product Owner para maximizar el valor.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 8 -->
                <div class="question">
                    <h3>¿Qué importancia das a la mejora continua dentro del equipo?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p8[]" value="1" id="p8-1">
                            <label for="p8-1">Prefiero mantener procesos estables sin muchos cambios.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p8[]" value="2" id="p8-2">
                            <label for="p8-2">Apoyo mejoras cuando son sugeridas por otros.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p8[]" value="3" id="p8-3">
                            <label for="p8-3">Tomamos activamente la experimentación y el aprendizaje continuo.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 9 -->
                <div class="question">
                    <h3>¿Qué tan cómodo te sientes trabajando en un entorno de cambio constante?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p9[]" value="1" id="p9-1">
                            <label for="p9-1">Prefiero un entorno estructurado con cambios mínimos.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p9[]" value="2" id="p9-2">
                            <label for="p9-2">Me adapto a los cambios cuando son necesarios, pero prefiero estabilidad.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p9[]" value="3" id="p9-3">
                            <label for="p9-3">Me siento cómodo con el cambio y ayudo al equipo a verlo como una oportunidad de mejora.</label>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 10 -->
                <div class="question">
                    <h3>¿Qué haces cuando hay desacuerdos en el equipo sobre cómo abordar una tarea o funcionalidad?</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" name="p10[]" value="1" id="p10-1">
                            <label for="p10-1">Sigo adelante con mi propia solución sin involucrarme demasiado en la discusión.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p10[]" value="2" id="p10-2">
                            <label for="p10-2">Escucho las opiniones y trato de llegar a un consenso con el equipo.</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" name="p10[]" value="3" id="p10-3">
                            <label for="p10-3">Facilito una conversación estructurada para alinear perspectivas y tomar la mejor decisión conjunta.</label>
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Atrás</button>
                    <a href="/resultado_scrum" class="btn btn-primary">Finalizar Evaluación</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

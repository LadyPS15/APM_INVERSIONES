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

            <div class="form-group">
                <label>¿Qué haces cuando alguien del equipo tiene dificultades con su trabajo?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox" name="p6[]" value="1"> Dejo que lo resuelva por su cuenta.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p6[]" value="2"> Ayudo si me lo piden.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p6[]" value="3"> Identifico oportunidades para apoyar y fomentar un ambiente de aprendizaje.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Cómo te aseguras de que el trabajo del equipo aporte valor al cliente?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox" name="p7[]" value="1"> Me enfoco en completar mis tareas sin cuestionar su impacto.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p7[]" value="2"> Propongo mejores técnicas cuando es posible.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p7[]" value="3"> Facilito la colaboración entre el equipo y el Product Owner para maximizar el valor.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué importancia das a la mejora continua dentro del equipo?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox" name="p8[]" value="1"> Prefiero mantener procesos estables sin muchos cambios.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p8[]" value="2"> Apoyo mejoras cuando son sugeridas por otros.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p8[]" value="3"> Tomamos activamente la experimentación y el aprendizaje continuo.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué tan cómodo te sientes trabajando en un entorno de cambio constante?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox" name="p9[]" value="1"> Prefiero un entorno estructurado con cambios mínimos.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p9[]" value="2"> Me adapto a los cambios cuando son necesarios, pero prefiero estabilidad.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p9[]" value="3"> Me siento cómodo con el cambio y ayudo al equipo a verlo como una oportunidad de mejora.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué haces cuando hay desacuerdos en el equipo sobre cómo abordar una tarea o funcionalidad?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox" name="p10[]" value="1"> Sigo adelante con mi propia solución sin involucrarme demasiado en la discusión.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p10[]" value="2"> Escucho las opiniones y trato de llegar a un consenso con el equipo.</div>
                    <div class="checkbox-item"><input type="checkbox" name="p10[]" value="3"> Facilito una conversación estructurada para alinear perspectivas y tomar la mejor decisión conjunta.</div>
                </div>
            </div>

            <div class="buttons-container">
                <a href="/resultado_scrum" class="btn btn-primary">Finalizar Evaluación</a>
            </div>
        </div>
    </div>
</body>
</html>

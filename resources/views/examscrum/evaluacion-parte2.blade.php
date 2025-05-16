<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APM INVERSIONES - Evaluación</title>
    @vite('resources/css/evaluacion.css') {{-- Aquí puedes cambiar el CSS si tienes otro --}}
</head>
<body>git
    <div class="container">
        <div class="form-card">
            <h1>Evaluación de Scrum</h1>
            <div class="divider"></div>

            <div class="form-group">
                <label>¿Qué haces cuando alguien del equipo tiene dificultades con su trabajo?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox"> Dejo que lo resuelva por su cuenta.</div>
                    <div class="checkbox-item"><input type="checkbox"> Ayudo si me lo piden.</div>
                    <div class="checkbox-item"><input type="checkbox"> Identifico oportunidades para apoyar y fomentar un ambiente de aprendizaje.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Cómo te aseguras de que el trabajo del equipo aporte valor al cliente?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox"> Me enfoco en completar mis tareas sin cuestionar su impacto.</div>
                    <div class="checkbox-item"><input type="checkbox"> Propongo mejores técnicas cuando es posible.</div>
                    <div class="checkbox-item"><input type="checkbox"> Facilito la colaboración entre el equipo y el Product Owner para maximizar el valor.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué importancia das a la mejora continua dentro del equipo?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox"> Prefiero mantener procesos estables sin muchos cambios.</div>
                    <div class="checkbox-item"><input type="checkbox"> Apoyo mejoras cuando son sugeridas por otros.</div>
                    <div class="checkbox-item"><input type="checkbox"> Tomamos activamente la experimentación y el aprendizaje continuo.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué tan cómodo te sientes trabajando en un entorno de cambio constante?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox"> Prefiero un entorno estructurado con cambios mínimos.</div>
                    <div class="checkbox-item"><input type="checkbox"> Me adapto a los cambios cuando son necesarios, pero prefiero estabilidad.</div>
                    <div class="checkbox-item"><input type="checkbox"> Me siento cómodo con el cambio y ayudo al equipo a verlo como una oportunidad de mejora.</div>
                </div>
            </div>

            <div class="form-group">
                <label>¿Qué haces cuando hay desacuerdos en el equipo sobre cómo abordar una tarea o funcionalidad?</label>
                <div class="checkbox-group">
                    <div class="checkbox-item"><input type="checkbox"> Sigo adelante con mi propia solución sin involucrarme demasiado en la discusión.</div>
                    <div class="checkbox-item"><input type="checkbox"> Escucho las opiniones y trato de llegar a un consenso con el equipo.</div>
                    <div class="checkbox-item"><input type="checkbox"> Facilito una conversación estructurada para alinear perspectivas y tomar la mejor decisión conjunta.</div>
                </div>
            </div>

            <div class="buttons-container">
                <a href="/results/resultado_scrum" class="btn btn-primary">Finalizar Evaluación</a>
            </div>
        </div>
    </div>
</body>
</html>

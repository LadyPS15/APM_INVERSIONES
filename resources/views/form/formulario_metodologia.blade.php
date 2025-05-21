<!-- resources/views/experiencia-agile.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Practicante - Experiencia en Metodologías Ágiles</title>
    @vite('resources/css/form_metodologia.css')
</head>
<body>
    <div class="header-title">
        Registro del Practicante- Información personal
    </div>

    <div class="container">
        <div class="form-card">
            <h2>Experiencia en Metodología Agiles</h2>
            <div class="divider"></div>

            <form action="{{ route('form.guardarFormularioMetodologia', ['applicant' => $applicant->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>¿Tienes experiencia en metodologías Scrum?</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="experiencia_si" name="experiencia_scrum" value="si" required>
                            <label for="experiencia_si">Sí</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="experiencia_no" name="experiencia_scrum" value="no" required>
                            <label for="experiencia_no">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="tiempo_experiencia_container">
                    <label>Tiempo de experiencia</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="tiempo_menos_3" name="tiempo_experiencia" value="menos_3">
                            <label for="tiempo_menos_3">Menos de 3 meses</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="tiempo_3_6" name="tiempo_experiencia" value="3_6">
                            <label for="tiempo_3_6">Entre 3 y 6 meses</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="tiempo_6_12" name="tiempo_experiencia" value="6_12">
                            <label for="tiempo_6_12">Entre 6 y 12 meses</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="tiempo_mas_1" name="tiempo_experiencia" value="mas_1">
                            <label for="tiempo_mas_1">Más de 1 año</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="rol_principal_container">
                    <label for="rol_principal">Rol principal desempeñado</label>
                    <select id="rol_principal" name="rol_principal" class="form-control" disabled>
                        <option value="" selected disabled>Seleccione una opción</option>
                        @foreach($scrumRoles as $role)
                            <option value="{{ $role->name }}" {{ $applicant->rol_principal == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="tipo_proyectos_container">
                    <label for="tipo_proyectos">¿En qué tipo de proyectos has aplicado metodologías Scrum?</label>
                    <textarea id="tipo_proyectos" name="tipo_proyectos" class="form-control" rows="4" disabled></textarea>
                </div>


                            <div class="buttons-container">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>

    document.addEventListener('DOMContentLoaded', function () {
    const experienciaSi = document.getElementById('experiencia_si');
    const experienciaNo = document.getElementById('experiencia_no');

    const tiempoContainer = document.getElementById('tiempo_experiencia_container');
    const rolPrincipalContainer = document.getElementById('rol_principal_container');
    const tipoProyectosContainer = document.getElementById('tipo_proyectos_container');

    const rolPrincipalSelect = document.getElementById('rol_principal');
    const tipoProyectosTextarea = document.getElementById('tipo_proyectos');
    const tiempoRadios = tiempoContainer.querySelectorAll('input');

    function toggleCampos() {
        if (experienciaSi.checked) {
            // Mostrar y habilitar
            tiempoContainer.style.display = 'block';
            tiempoRadios.forEach(input => input.disabled = false);

            rolPrincipalSelect.disabled = false;
            tipoProyectosTextarea.disabled = false;
        } else {
            // Ocultar y deshabilitar + limpiar selección
            tiempoContainer.style.display = 'none';
            tiempoRadios.forEach(input => {
                input.disabled = true;
                input.checked = false;
            });

            rolPrincipalSelect.disabled = true;
            rolPrincipalSelect.value = "";

            tipoProyectosTextarea.disabled = true;
            tipoProyectosTextarea.value = "";
        }
    }

    experienciaSi.addEventListener('change', toggleCampos);
    experienciaNo.addEventListener('change', toggleCampos);

    toggleCampos(); // Estado inicial al cargar la página
});

</script>

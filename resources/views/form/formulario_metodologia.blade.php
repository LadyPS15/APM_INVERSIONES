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

            <form action="#" method="POST">
                @csrf

                <div class="form-group">
                    <label>¿Tienes experiencia en metodologías Scrum?</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="experiencia_si" name="experiencia_scrum" value="si">
                            <label for="experiencia_si">Sí</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="experiencia_no" name="experiencia_scrum" value="no">
                            <label for="experiencia_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
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

                <div class="form-group">
                    <label for="rol_principal">Rol principal desempeñado</label>
                    <select id="rol_principal" name="rol_principal" class="form-control">
                        <option value="" selected disabled>Seleccione una opción</option>
                        <option value="scrum_master">Scrum Master</option>
                        <option value="product_owner">Product Owner</option>
                        <option value="desarrollador">Desarrollador</option>
                        <option value="tester">Tester</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tipo_proyectos">¿En qué tipo de proyectos has aplicado metodologías Scrum?</label>
                    <textarea id="tipo_proyectos" name="tipo_proyectos" class="form-control" rows="4"></textarea>
                </div>

                <div class="buttons-container">
                    <button type="submit" class="btn btn-primary">Enviar Registro</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

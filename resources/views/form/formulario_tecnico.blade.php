<!-- resources/views/perfil-tecnico.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Practicante - Perfil Técnico</title>
    @vite('resources/css/form_tecnico.css')
</head>
<body>
    <div class="header-title">
        Registro del Practicante- Perfil Técnico
    </div>
    
    <div class="container">
        <div class="form-card">
            <h2>Perfil Técnico</h2>
            <div class="divider"></div>
            
            <form action="#" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="area_enfoque">Área de enfoque</label>
                    <select id="area_enfoque" name="area_enfoque" class="form-control">
                        <option value="" selected disabled>Seleccione una opción</option>
                        <option value="desarrollo_web">Desarrollo Web</option>
                        <option value="desarrollo_movil">Desarrollo Móvil</option>
                        <option value="ciencia_datos">Ciencia de Datos</option>
                        <option value="inteligencia_artificial">Inteligencia Artificial</option>
                        <option value="seguridad_informatica">Seguridad Informática</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Lenguajes de Programación</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="php" name="lenguajes[]" value="php">
                            <label for="php">PHP</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="python" name="lenguajes[]" value="python">
                            <label for="python">Python</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="javascript" name="lenguajes[]" value="javascript">
                            <label for="javascript">JavaScript</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="csharp" name="lenguajes[]" value="csharp">
                            <label for="csharp">C#</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="otro" name="lenguajes[]" value="otro">
                            <label for="otro">Otro</label>
                        </div>
                    </div>
                    
                    <input type="text" id="otros_lenguajes" name="otros_lenguajes" class="form-control" placeholder="Especifique otros lenguajes">
                </div>
                
                <div class="form-group">
                    <label for="disponibilidad">Disponibilidad Horaria</label>
                    <select id="disponibilidad" name="disponibilidad" class="form-control">
                        <option value="" selected disabled>Seleccione una opción</option>
                        <option value="tiempo_completo">08:00 AM a 14:00 PM</option>
                        <option value="medio_tiempo">14:00 PM a 20:00 PM </option>
                        <option value="por_horas">Por Horas</option>
                    </select>
                </div>
                
                <div class="buttons-container">
                    <a href="#" class="btn btn-secondary">Atrás</a>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
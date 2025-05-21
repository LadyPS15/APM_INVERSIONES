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
            
            <form action="{{ route('form.guardarPerfilTecnico', ['applicant' => $applicant->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="especializacion">Área de enfoque</label>
                    <select id="especializacion" name="especializacion" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}" {{ $applicant->specialization_id == $specialization->id ? 'selected' : '' }}>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Lenguajes de Programación</label>
                    @foreach($programmingLanguages as $language)
                        <div>
                            <input
                                type="checkbox"
                                name="lenguajes[]"
                                value="{{ $language->name }}"
                                id="lenguaje_{{ $language->id }}"
                                {{ $applicant->programming_languages && in_array($language->name, explode(',', $applicant->programming_languages)) ? 'checked' : '' }}
                            >
                            <label for="lenguaje_{{ $language->id }}">{{ $language->name }}</label>
                        </div>
                    @endforeach

                    <input type="text" id="otros_lenguajes" name="otros_lenguajes" class="form-control" placeholder="Especifique otros lenguajes" value="{{ $applicant->otros_lenguajes }}">
                </div>

                <div class="form-group">
                    <label for="disponibilidad">Disponibilidad Horaria</label>
                    <select id="disponibilidad" name="disponibilidad" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach($schedules as $schedule)
                            <option value="{{ $schedule->description }}" {{ $applicant->availability == $schedule->description ? 'selected' : '' }}>
                                {{ $schedule->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="buttons-container">
                    <a href="{{ route('form.formulario') }}" class="btn btn-secondary">Atrás</a>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>

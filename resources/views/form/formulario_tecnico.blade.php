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

            {{-- AÑADE ESTO PARA MOSTRAR ERRORES DE VALIDACIÓN --}}
            @if ($errors->any())
                <div class="alert alert-danger"
                    style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- FIN DE LOS ERRORES DE VALIDACIÓN --}}

            <form action="{{ route('form.guardarPerfilTecnico', ['applicant' => $applicant->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="especializacion">Área de enfoque</label>
                    <select id="especializacion" name="especializacion_select" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->id }}"
                                {{ $applicant->specialization_id == $specialization->id ? 'selected' : '' }}>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                        <option value="otro_area">Otro</option>
                    </select>
                    <div id="otro_area_input" class="other-input" style="display: none;">
                        <input type="text" name="especializacion_otro" class="form-control"
                            placeholder="Especifique el área de enfoque"
                            value="{{ old('especializacion_otro', $applicant->other_specialization ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Lenguajes de Programación</label>
                    @foreach ($programmingLanguages as $language)
                        <div>
                            <input type="checkbox" name="lenguajes[]" value="{{ $language->name }}"
                                id="lenguaje_{{ $language->id }}"
                                {{ $applicant->programming_languages && in_array($language->name, explode(',', $applicant->programming_languages)) ? 'checked' : '' }}>
                            <label for="lenguaje_{{ $language->id }}">{{ $language->name }}</label>
                        </div>
                    @endforeach
                    <div>
                        <input type="checkbox" id="otro_lenguaje_checkbox" name="lenguajes[]" value="Otro">
                        <label for="otro_lenguaje_checkbox">Otro</label>
                    </div>
                    <div id="otro_lenguaje_input" class="other-input" style="display: none;">
                        <input type="text" name="otros_lenguajes_text" class="form-control"
                            placeholder="Especifique otros lenguajes"
                            value="{{ old('otros_lenguajes_text', $applicant->otros_lenguajes ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="disponibilidad">Disponibilidad Horaria</label>
                    <input list="disponibilidad_options" id="disponibilidad" name="disponibilidad" class="form-control"
                        placeholder="Seleccione o ingrese una opción"
                        value="{{ old('disponibilidad', $applicant->availability ?? '') }}" required>
                    <datalist id="disponibilidad_options">
                        <option value="" disabled>Seleccione una opción</option>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->description }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="buttons-container">
                    <a href="{{ route('form.formulario') }}" class="btn btn-secondary">Atrás</a>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tu script JavaScript aquí --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Area de enfoque "Otro" functionality
            const especializacionSelect = document.getElementById('especializacion');
            const otroAreaInputDiv = document.getElementById('otro_area_input');
            const otroAreaInput = otroAreaInputDiv.querySelector('input');

            especializacionSelect.addEventListener('change', function() {
                if (this.value === 'otro_area') {
                    otroAreaInputDiv.style.display = 'block';
                    otroAreaInput.setAttribute('required', 'required');
                } else {
                    otroAreaInputDiv.style.display = 'none';
                    otroAreaInput.removeAttribute('required');
                    otroAreaInput.value = ''; // Clear the input if "Otro" is deselected
                }
            });

            // Initial check for "Area de enfoque" if an "other" value was previously saved
            // This part might need adjustment if old('especializacion_otro') is not correctly set.
            // Let's rely on the validation errors for now.
            if (especializacionSelect.value === 'otro_area' || (especializacionSelect.value === '' && otroAreaInput
                    .value !== '')) {
                especializacionSelect.value = 'otro_area'; // Set dropdown to "Otro" if text input has value
                otroAreaInputDiv.style.display = 'block';
                otroAreaInput.setAttribute('required', 'required');
            }


            // Lenguajes de Programacion "Otro" functionality
            const otroLenguajeCheckbox = document.getElementById('otro_lenguaje_checkbox');
            const otroLenguajeInputDiv = document.getElementById('otro_lenguaje_input');
            const otroLenguajeInput = otroLenguajeInputDiv.querySelector('input');

            otroLenguajeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    otroLenguajeInputDiv.style.display = 'block';
                    otroLenguajeInput.setAttribute('required', 'required');
                } else {
                    otroLenguajeInputDiv.style.display = 'none';
                    otroLenguajeInput.removeAttribute('required');
                    otroLenguajeInput.value = ''; // Clear the input if "Otro" is deselected
                }
            });

            // Initial check for "Lenguajes de Programacion" if an "other" value was previously saved
            // This part might need adjustment if old('otros_lenguajes_text') is not correctly set.
            // Let's rely on the validation errors for now.
            if (otroLenguajeInput.value !== '') {
                otroLenguajeCheckbox.checked = true;
                otroLenguajeInputDiv.style.display = 'block';
                otroLenguajeInput.setAttribute('required', 'required');
            }
        });
    </script>
</body>

</html>

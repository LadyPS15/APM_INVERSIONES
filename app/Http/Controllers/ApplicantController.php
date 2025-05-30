<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\ScrumEvaluation;
use App\Models\Career;
use App\Models\ProgrammingLanguage;
use App\Models\Specialization;
use App\Models\Schedule;
use App\Models\ScrumRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    public function create()
    {
        $careers = Career::all();
        return view('form.formulario', compact('careers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:150',
            'email' => 'required|email|unique:applicants,email',
            'carrera' => 'required|exists:careers,id',
            'ciclo' => 'required|integer|between:1,10',
        ]);

        $applicant = Applicant::create([
            'full_name' => $request->nombres,
            'email' => $request->email,
            'career_id' => $request->carrera,
            'academic_cycle' => $request->ciclo,
            'access_token' => uniqid('token_', true),
        ]);

        return redirect()->route('form.formularioTecnico', ['applicant' => $applicant->id]);
    }

    public function perfilTecnico(Applicant $applicant)
    {
        $specializations = Specialization::all();
        $programmingLanguages = ProgrammingLanguage::all();
        $schedules = Schedule::all();

        return view('form.formulario_tecnico', compact('specializations', 'programmingLanguages', 'schedules', 'applicant'));
    }

    public function guardarPerfilTecnico(Request $request, Applicant $applicant)
    {
        $request->validate([
            // 'especializacion_select' solo debe existir en la tabla 'specializations'
            // SI Y SOLO SI no se ha llenado 'especializacion_otro'.
            // También debe ser 'nullable' para que no falle si 'especializacion_otro' está presente.
            'especializacion_select' => [
                'required_without:especializacion_otro',
                'nullable', // Permitir que sea null si 'otro' está presente
                function ($attribute, $value, $fail) use ($request) {
                    // Validar 'exists' solo si el valor no es 'otro_area'
                    if ($value !== 'otro_area' && $request->filled('especializacion_select')) {
                        if (!Specialization::where('id', $value)->exists()) {
                            $fail('The selected especializacion select is invalid.');
                        }
                    }
                },
            ],
            // 'especializacion_otro' es requerido si 'especializacion_select' está vacío.
            'especializacion_otro' => 'required_without:especializacion_select|nullable|string|max:255',

            // Las demás validaciones
            'lenguajes' => 'nullable|array',
            'otros_lenguajes_text' => 'nullable|string|max:255',
            'disponibilidad' => 'required|string|max:255',
        ]);

        // 1. Guardar Área de enfoque (specialization_id y other_specialization)
        if ($request->filled('especializacion_select') && $request->input('especializacion_select') !== 'otro_area') {
            // Si el usuario seleccionó una opción existente del dropdown
            $applicant->specialization_id = $request->input('especializacion_select');
            $applicant->other_specialization = null; // Asegurarse de que el campo "otro" esté nulo
        } elseif ($request->filled('especializacion_otro')) {
            // Si el usuario ingresó texto en el campo "Otro"
            $applicant->specialization_id = null; // Asegurarse de que no haya un ID de especialización existente
            $applicant->other_specialization = $request->input('especializacion_otro');
        } else {
            // Caso donde no se seleccionó ni se escribió nada (las reglas de validación deberían prevenir esto, pero es un fallback)
            $applicant->specialization_id = null;
            $applicant->other_specialization = null;
        }

        // 2. Guardar Lenguajes de Programación (programming_languages y otros_lenguajes)
        $selectedLanguages = $request->input('lenguajes', []); // Obtiene los valores de los checkboxes

        // Filtra el valor "Otro" del array si se seleccionó como checkbox.
        // Esto es porque el texto real de "otros" se guardará en el campo 'otros_lenguajes' de la BD.
        $selectedLanguages = array_filter($selectedLanguages, function ($value) {
            return $value !== 'Otro';
        });

        // Implode los lenguajes seleccionados (no "Otro") en una cadena separada por comas
        $applicant->programming_languages = implode(',', $selectedLanguages);

        // Guarda el texto libre del campo "Especifique otros lenguajes" en el campo 'otros_lenguajes' de la BD
        $applicant->otros_lenguajes = $request->input('otros_lenguajes_text');

        // 3. Guardar Disponibilidad Horaria (availability)
        $applicant->availability = $request->input('disponibilidad');

        // Guardar todos los cambios en la base de datos
        $applicant->save();

        return redirect()->route('form.formularioMetodologia', ['applicant' => $applicant->id])
            ->with('success', 'Perfil técnico guardado exitosamente.');;
    }

    public function formularioMetodologia(Applicant $applicant)
    {
        $scrumRoles = ScrumRole::all();
        return view('form.formulario_metodologia', compact('applicant', 'scrumRoles'));
    }

    public function guardarFormularioMetodologia(Request $request, Applicant $applicant)
    {
        $request->validate([
            'experiencia_scrum' => 'required|in:si,no',
            'tiempo_experiencia' => 'required_if:experiencia_scrum,si|string',
            'rol_principal' => 'required_if:experiencia_scrum,si|string',
            'tipo_proyectos' => 'nullable|string',
        ]);

        $applicant->experiencia_scrum = $request->experiencia_scrum;
        $applicant->tiempo_experiencia = $request->tiempo_experiencia;
        $applicant->rol_principal = $request->rol_principal;
        $applicant->tipo_proyectos = $request->tipo_proyectos;
        $applicant->save();

        if ($request->experiencia_scrum === 'si') {
            return redirect()->route('evaluacion.scrum', ['applicant' => $applicant->id]);
        } else {
            return redirect()->route('resultado.general', ['applicant' => $applicant->id]);
        }
    }

    // Mostrar formulario preguntas 1-5
    public function evaluacionScrum(Applicant $applicant)
    {
        return view('examscrum.evaluacion', compact('applicant'));
    }

    // Guardar respuestas preguntas 1-6 y redirigir a preguntas 7-12
    public function guardarEvaluacionScrum(Request $request, Applicant $applicant)
    {
        $request->validate([
            'p1' => 'required|string',
            'p2' => 'required|string',
            'p3' => 'required|string',
            'p4' => 'required|string',
            'p5' => 'required|string',
            'p6' => 'required|string',
        ]);

        $scrumEval = $applicant->scrumEvaluation ?? new ScrumEvaluation();
        $scrumEval->applicant_id = $applicant->id;
        $answersPart1 = [
            'p1' => $request->input('p1'),
            'p2' => $request->input('p2'),
            'p3' => $request->input('p3'),
            'p4' => $request->input('p4'),
            'p5' => $request->input('p5'),
            'p6' => $request->input('p6'),
        ];
        // Laravel se encargará de convertir automáticamente el array a JSON
        $scrumEval->answers_part1 = $answersPart1;

        $scrumEval->save();

        return redirect()->route('evaluacion.scrum2', ['applicant' => $applicant->id]);
    }

    // Mostrar formulario preguntas 6-10
    public function evaluacionScrum2(Applicant $applicant)
    {
        return view('examscrum.evaluacion2', compact('applicant'));
    }

    // Guardar respuestas preguntas 6-10, calcular puntaje, predecir rol y mostrar resultados
    public function guardarEvaluacionScrum2(Request $request, Applicant $applicant)
    {
        $request->validate([
            'p7' => 'required|string',
            'p8' => 'required|string',
            'p9' => 'required|string',
            'p10' => 'required|string',
            'p11' => 'required|string',
            'p12' => 'required|string',
        ]);

        // Si la evaluación ya existe, la obtenemos; de lo contrario, creamos una nueva.
        // Es crucial que 'scrumEvaluation' en $applicant ya esté cargado o sea null.
        // Asumo que en este punto ya debería tener un registro de ScrumEvaluation
        // asociado al applicant, creado en el paso anterior.
        $scrumEval = $applicant->scrumEvaluation;

        // Si por alguna razón no existe (ej. la evaluación anterior no se guardó), podrías crearlo:
        if (!$scrumEval) {
            $scrumEval = new ScrumEvaluation();
            $scrumEval->applicant_id = $applicant->id;
            // Si la evaluación anterior no se guardó, 'answers_part1' estaría vacío,
            // lo cual podría afectar el cálculo del puntaje total si usa ambas partes.
        }
        // Almacenar las respuestas de la segunda parte (p7 a p12)
        // Cada 'pX' ahora contiene la cadena de texto del textarea.
        $answersPart2 = [
            'p7' => $request->input('p7'),
            'p8' => $request->input('p8'),
            'p9' => $request->input('p9'),
            'p10' => $request->input('p10'),
            'p11' => $request->input('p11'),
            'p12' => $request->input('p12'),
        ];

        // Laravel serializará automáticamente $answersPart2 a JSON si 'answers_part2'
        // está casteado como 'array' en el modelo ScrumEvaluation.
        $scrumEval->answers_part2 = $answersPart2;


        // Calcular puntaje total
        $score = $this->calcularPuntaje($scrumEval);

        // Predecir rol Scrum
        $predictedRole = $this->predecirRolScrum($scrumEval);

        $scrumEval->score = $score;
        $scrumEval->predicted_role = $predictedRole;
        $scrumEval->save();

        // Actualizar Applicant con puntaje y rol
        $applicant->scrum_score = $score;
        $applicant->rol_principal = $predictedRole;
        $applicant->save();

        return redirect()->route('resultado.scrum', ['applicant' => $applicant->id]);
    }

    // Mostrar resultados de evaluación Scrum
    public function resultadoScrum(Applicant $applicant)
    {
        $scrumEval = $applicant->scrumEvaluation;
        $scrum_score = $scrumEval ? $scrumEval->score : 0;

        return view('results.resultado_scrum', compact('applicant', 'scrum_score'));
    }

    /**
     * Método para calcular puntaje total basado en respuestas de texto.
     * Adaptado para manejar respuestas de textarea.
     */
    // Método para calcular puntaje total basado en respuestas
    protected function calcularPuntaje(ScrumEvaluation $eval)
    {
        $score = 0;

        $part1_answers = $eval->answers_part1 ?? [];
        $part2_answers = $eval->answers_part2 ?? [];

        // Combinar todas las respuestas para iterar sobre ellas
        $all_answers = array_merge($part1_answers, $part2_answers);

        foreach ($all_answers as $question_key => $answer_text) {
            // Asegurarse de que sea una cadena de texto
            if (is_string($answer_text)) {
                // Genera un valor para cada respuesta de texto.
                $valor_respuesta = $this->generarValorRespuesta($question_key, $answer_text);
                $score += $valor_respuesta;
            }
        }

        // Tienes 12 preguntas en total (6 en parte 1, 6 en parte 2).
        // Si el máximo ideal para cada pregunta es 2.5 (como en `generarValorRespuesta`),
        // entonces el puntaje máximo teórico es 12 * 2.5 = 30.
        $max_theoretical_score = 30;
        // Normalizar puntaje a una escala de 0 a 10
        return round(min($score, $max_theoretical_score) / $max_theoretical_score * 10, 1);
    }

    //Asigna un valor numérico a una respuesta de texto basada en la pregunta.

    protected function generarValorRespuesta(string $question_key, string $answer_text): float
    {
        // Convertir a minúsculas para una comparación sin distinción entre mayúsculas y minúsculas
        $answer_text_lower = strtolower($answer_text);
        $score_for_question = 0;

        // Puntos base por longitud de la respuesta, asumiendo que más detalle es mejor
        // Ajusta estos umbrales y puntos según tu criterio
        if (strlen($answer_text) > 70) {
            $score_for_question += 1.0;
        } elseif (strlen($answer_text) > 30) {
            $score_for_question += 0.5;
        }

        // Lógica de puntuación por palabras clave específicas para cada pregunta
        switch ($question_key) {
            // Preguntas de la Parte 1
            case 'p1': // ¿Cómo te aseguras de que tus ideas sean comprendidas por todos los miembros del equipo?
                if (Str::contains($answer_text_lower, ['claridad', 'ejemplos', 'analogías', 'feedback', 'retroalimentación', 'escucha activa'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p2': // Describe una situación en la que tuviste que explicar un concepto técnico a alguien sin conocimientos técnicos. ¿Cómo lo hiciste?
                if (Str::contains($answer_text_lower, ['analogías', 'metaforas', 'ejemplos prácticos', 'simplificar', 'paciencia', 'lenguaje sencillo'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p3': // ¿Cómo reaccionas cuando alguien no está de acuerdo contigo en una reunión de equipo?
                if (Str::contains($answer_text_lower, ['escuchar', 'entender perspectiva', 'diálogo', 'argumentos', 'datos', 'respeto', 'consenso'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p4': // Cuéntanos sobre una experiencia en la que trabajaste en equipo ¿Qué rol desempeñaste y cómo contribuiste al éxito del grupo?
                if (Str::contains($answer_text_lower, ['lideré', 'colaboré', 'apoyé', 'contribución', 'éxito', 'logro', 'rol'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p5': // ¿Cómo manejas los conflictos dentro de un equipo?
                if (Str::contains($answer_text_lower, ['mediación', 'solución', 'facilitación', 'comunicación abierta', 'entender las partes', 'compromiso'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p6': // ¿Qué estrategias usas para colaborar efectivamente con compañeros que piensan diferente a ti?
                if (Str::contains($answer_text_lower, ['respeto', 'empatía', 'objetivo común', 'escuchar activamente', 'comprensión', 'perspectivas'])) {
                    $score_for_question += 1.5;
                }
                break;

            // Preguntas de la Parte 2
            case 'p7': // ¿Alguna vez lideraste un equipo en un proyecto académico o personal? Describe tu experiencia.
                if (Str::contains($answer_text_lower, ['liderazgo', 'coordiné', 'responsable', 'guiar', 'mentoria', 'desarrollo de equipo', 'manejo de equipo'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p8': // ¿Qué decisiones importantes has tenido que tomar en un proyecto y cómo llegaste a ellas?
                if (Str::contains($answer_text_lower, ['análisis', 'información', 'consecuencias', 'impacto', 'riesgos', 'datos', 'racional', 'alternativas'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p9': // ¿Cómo motivas a otros cuando el equipo está desanimado o bloqueado?
                if (Str::contains($answer_text_lower, ['reconocimiento', 'celebrar', 'metas pequeñas', 'escuchar', 'apoyo', 'inspirar', 'soluciones', 'optimismo'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p10': // ¿Has participado en alguna reunión diaria (Daily Scrum)? Si es así, ¿qué aportabas normalmente?
                if (Str::contains($answer_text_lower, ['daily scrum', 'reunión diaria', 'stand-up', 'impedimentos', 'bloqueos', 'progreso', 'tareas realizadas', 'sprint goal'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p11': // Describe tu experiencia, si la tienes, trabajando bajo metodologías ágiles. ¿Qué aprendiste de ese enfoque?
                if (Str::contains($answer_text_lower, ['ágil', 'scrum', 'kanban', 'iteraciones', 'flexibilidad', 'adaptación', 'aprendizaje continuo', 'mejora', 'feedback'])) {
                    $score_for_question += 1.5;
                }
                break;
            case 'p12': // ¿Qué tipo de tareas te asignaban normalmente en proyectos anteriores y cómo las gestionabas?
                if (Str::contains($answer_text_lower, ['gestionaba', 'organizaba', 'priorizaba', 'desarrollo', 'testing', 'diseño', 'análisis', 'implementación', 'seguimiento'])) {
                    $score_for_question += 1.5;
                }
                break;
            // Añade más casos para cada pregunta si lo necesitas
            default:
                // Si una pregunta no tiene lógica específica, darle un puntaje base o 0
                $score_for_question = 0;
                break;
        }

        // Limita el puntaje máximo por pregunta para evitar que una sola respuesta buena domine el score.
        // Aquí lo he puesto en 2.5 (1.0 por longitud + 1.5 por palabras clave).
        return min($score_for_question, 2.5);
    }

    // Método para predecir rol Scrum basado en respuestas
    protected function predecirRolScrum(ScrumEvaluation $eval)
    {
        $part1_answers = $eval->answers_part1 ?? [];
        $part2_answers = $eval->answers_part2 ?? [];

        // Inicializar puntajes para cada rol
        $sm_score = 0; // Scrum Master
        $po_score = 0; // Product Owner
        $dev_score = 0; // Development Team

        // Define las palabras clave o criterios para cada rol para las preguntas
        // Agrupo las preguntas por rol que tienden a evaluar, considerando ambas partes del formulario.
        $role_keywords = [
            'Scrum Master' => [
                'p1' => ['claridad', 'escucha activa', 'facilitar', 'retroalimentación'], // Comunicación, Facilitación
                'p3' => ['conflicto', 'mediación', 'resolución', 'neutral', 'consenso'], // Manejo de conflictos
                'p5' => ['manejar conflictos', 'mediación', 'solución', 'facilitar', 'comunicación abierta'], // Manejo de conflictos (repetido, pero más específico)
                'p6' => ['colaborar', 'diferente', 'respeto', 'empatía', 'objetivo común'], // Colaboración, Inclusividad
                'p7' => ['liderazgo', 'guiar', 'mentoria', 'desarrollo de equipo'], // Liderazgo de servicio
                'p9' => ['motivar', 'superar', 'bloqueos', 'optimismo', 'apoyo'], // Motivación, Eliminación de impedimentos
                'p10' => ['daily scrum', 'impedimentos', 'bloqueos', 'facilitar', 'alineación'], // Reuniones, Impedimentos
                'p11' => ['ágil', 'aprendizaje continuo', 'mejora', 'coaching', 'adaptación'], // Agilidad, Mejora Continua
            ],
            'Product Owner' => [
                'p1' => ['visión', 'objetivos', 'priorización', 'cliente', 'valor'], // Comunicación de visión
                'p2' => ['explicar', 'concepto técnico', 'sin conocimientos técnicos', 'valor de negocio', 'necesidades'], // Comunicación de requisitos
                'p4' => ['rol', 'contribución', 'éxito', 'impacto', 'valor', 'resultados'], // Orientación a resultados y valor
                'p7' => ['liderazgo', 'decisiones', 'impacto', 'visión', 'estrategia'], // Liderazgo, Toma de decisiones estratégicas
                'p8' => ['decisiones importantes', 'análisis', 'información', 'riesgos', 'impacto', 'prioridad'], // Toma de decisiones, Priorización
                'p11' => ['ágil', 'feedback', 'iteraciones', 'flexibilidad', 'adaptación', 'mercado'], // Adaptación, Valor de producto
                'p12' => ['tareas', 'priorización', 'gestión', 'backlog', 'requisitos', 'cliente'], // Gestión de backlog, Enfoque en cliente
            ],
            'Development Team' => [
                'p1' => ['comprendidas', 'solución', 'implementar', 'trabajo'], // Enfocado en la implementación
                'p2' => ['resolver', 'problema', 'ejecutar', 'código', 'desarrollo'], // Capacidad técnica para resolver
                'p3' => ['acuerdo', 'solución técnica', 'mejor forma', 'ejecución'], // Colaboración técnica
                'p4' => ['trabajé en equipo', 'mi rol', 'contribución', 'desarrollo', 'implementación', 'pruebas'], // Colaboración, Rol técnico
                'p5' => ['solucionar', 'conflicto', 'equipo', 'trabajo', 'productividad'], // Enfocado en el trabajo del equipo
                'p6' => ['colaborar', 'diferente', 'enfoque técnico', 'solución'], // Adaptación técnica
                'p7' => ['lideré', 'proyecto', 'contribución', 'desarrollo', 'implementación'], // Liderazgo en el desarrollo
                'p8' => ['decisiones', 'técnicas', 'solución', 'método', 'diseño'], // Toma de decisiones técnicas
                'p9' => ['motivación', 'bloqueado', 'solución', 'ayuda', 'conocimiento'], // Apoyo técnico, Resolución de problemas
                'p10' => ['daily scrum', 'progreso', 'tareas', 'terminado', 'próximos pasos'], // Participación en Daily
                'p11' => ['ágil', 'desarrollo', 'código', 'pruebas', 'iteraciones', 'entrega'], // Prácticas ágiles de desarrollo
                'p12' => ['tareas asignadas', 'gestión', 'código', 'testing', 'desarrollo', 'implementación'], // Gestión de tareas técnicas
            ],
        ];

        // Función auxiliar para calcular el "score" de un texto en base a palabras clave
        $calculate_text_score = function ($text, $keywords) {
            $score = 0;
            $text_lower = strtolower($text);
            foreach ($keywords as $keyword) {
                if (str_contains($text_lower, $keyword)) {
                    $score += 1; // Un punto por cada palabra clave encontrada
                }
            }
            return $score;
        };

        // Recorrer todas las respuestas y sumar puntos para cada rol
        $all_answers = array_merge($part1_answers, $part2_answers);
        foreach ($all_answers as $question_key => $answer_text) {
            if (is_string($answer_text)) {
                // Sumar puntos para Scrum Master
                if (isset($role_keywords['Scrum Master'][$question_key])) {
                    $sm_score += $calculate_text_score($answer_text, $role_keywords['Scrum Master'][$question_key]);
                }
                // Sumar puntos para Product Owner
                if (isset($role_keywords['Product Owner'][$question_key])) {
                    $po_score += $calculate_text_score($answer_text, $role_keywords['Product Owner'][$question_key]);
                }
                // Sumar puntos para Development Team
                if (isset($role_keywords['Development Team'][$question_key])) {
                    $dev_score += $calculate_text_score($answer_text, $role_keywords['Development Team'][$question_key]);
                }
            }
        }

        // Determinar el rol con el puntaje más alto
        $max_score = max($sm_score, $po_score, $dev_score);

        if ($max_score == 0) {
            return 'No definido'; // Si no se encontraron palabras clave relevantes en ninguna respuesta
        }

        // Determinar el rol principal (manejar empates si es necesario)
        $roles = [
            'Scrum Master' => $sm_score,
            'Product Owner' => $po_score,
            'Development Team' => $dev_score,
        ];

        // Ordenar los roles por puntaje de mayor a menor
        arsort($roles);

        // Retornar el rol con el puntaje más alto. Si hay empate, el primero en el array ordenado.
        foreach ($roles as $role => $score) {
            if ($score == $max_score) {
                return $role;
            }
        }

        return 'No definido'; // En caso de cualquier situación inesperada
    }

    public function resultadoGeneral(Applicant $applicant)
    {
        $score = 0;

        // 1. Ciclo académico (1 a 6) mapeamos linealmente a 0.5 a 2 puntos
        $score += min(max($applicant->academic_cycle, 1), 6) * (2 / 6);

        // 2. Especialización
        // $score += $applicant->specialization_id ? 2 : 0;
        $hasSpecialization = false;
        if (!empty($applicant->specialization_id)) {
            $hasSpecialization = true;
        } elseif (!empty($applicant->other_specialization)) {
            $hasSpecialization = true;
        }
        $score += $hasSpecialization ? 2 : 0;

        // 3. Lenguajes de programación
        // $score += min($langsCount, 4) * (2 / 4);
        $allLanguages = [];

        if (!empty($applicant->programming_languages)) {
            // Divide por coma y trim (eliminar espacios extra)
            $allLanguages = array_merge($allLanguages, array_map('trim', explode(',', $applicant->programming_languages)));
        }
        if (!empty($applicant->otros_lenguajes)) {
            // Divide por coma y trim
            $allLanguages = array_merge($allLanguages, array_map('trim', explode(',', $applicant->otros_lenguajes)));
        }
        // Eliminar duplicados y contar
        $uniqueLanguages = array_unique($allLanguages);
        $langsCount = count($uniqueLanguages);
        // Puedes ajustar el divisor para cambiar la ponderación. Si 4 lenguajes valen 2 puntos.
        $score += min($langsCount, 4) * (2 / 4);

        // 4. Disponibilidad horaria (simple ejemplo)
        // $score += $availabilityPoints;
        // **4. Disponibilidad horaria:** Asigna puntos según la disponibilidad.
        // Formato: "HH:MM AM/PM a HH:MM AM/PM"
        $availabilityPoints = 0;
        $availabilityText = Str::lower($applicant->availability ?? '');

        // Puedes intentar extraer las horas o buscar patrones comunes.
        // Una forma sencilla es buscar palabras clave que indiquen tiempo completo/parcial o rangos largos.
        // Ejemplo simplificado: si contiene "9:00 am" y "5:00 pm" podría indicar full time.
        // Esto puede ser tan sofisticado como necesites (parseando horas exactas si es necesario).
        // Aumentando la robustez de la detección de "tiempo completo"
        if (Str::contains($availabilityText, ['tiempo completo', 'full time'])) {
            $availabilityPoints = 2; // Otorga el máximo si está explícito
        } elseif (
            Str::contains($availabilityText, ['8:00', '9:00']) &&
            Str::contains($availabilityText, ['5:00', '6:00', '7:00']) &&
            Str::contains($availabilityText, ['am']) &&
            Str::contains($availabilityText, ['pm'])
        ) {
            // Patrón para un rango de 8-9 horas que implica tiempo completo (ej. 9:00 AM a 05:00 PM)
            $availabilityPoints = 2;
        } elseif (Str::contains($availabilityText, ['mañana', 'manana'])) {
            $availabilityPoints = 1.5;
        } elseif (Str::contains($availabilityText, 'tarde')) {
            $availabilityPoints = 1;
        } elseif (Str::contains($availabilityText, 'noche')) {
            $availabilityPoints = 0.5;
        }
        $score += $availabilityPoints;

        // 5. Experiencia Scrum
        // $score += ($applicant->experiencia_scrum === 'si') ? 1 : 0;
        $score += (Str::lower($applicant->experiencia_scrum ?? '') === 'si') ? 1 : 0;

        // 6. Tiempo experiencia Scrum
        $timeExpPoints = 0;
        switch ($applicant->tiempo_experiencia) {
            case 'menos_3':
                $timeExpPoints = 0.5;
                break;
            case '3_6':
                $timeExpPoints = 1;
                break;
            case '6_12':
                $timeExpPoints = 1.5;
                break;
            case 'mas_1':
                $timeExpPoints = 2;
                break;
        }
        $score += $timeExpPoints;

        // Redondear y limitar máximo 10
        // $score = round(min($score, 10), 1);
        $scrumEvaluationScore = $applicant->scrum_score ?? 0;
        $score += ($scrumEvaluationScore / 10) * 4; // Max 4 puntos de la evaluación Scrum

        $max_total_score_theoretical = 15; // Mantenerlo si los pesos no cambian

        // Redondear y limitar el puntaje final a una escala de 0 a 10
        $final_normalized_score = round(min($score, $max_total_score_theoretical) / $max_total_score_theoretical * 10, 1);


        return view('results.resultado_general', [
            'applicant' => $applicant,
            'total_score' => $final_normalized_score,
            'predicted_role' => $applicant->rol_principal ?? 'N/A',
        ]);
    }

    // funciones del/para dasboard del reclutador
    // Mostrar dashboard del reclutador con todos los postulantes
    public function index()
    {
        $applicants = Applicant::with(['career', 'specialization', 'schedule', 'scrumRole', 'scrumEvaluation'])->get();
        return view('reclutador.dashboard', compact('applicants'));
    }

    public function accept($id)
    {
        $applicant = Applicant::findOrFail($id);
        // Aquí podría cambiar un estado si tuvieras una columna como "status"
        $applicant->status = 'aceptado';
        $applicant->save();

        // Si ya tiene cuenta, no volver a crear
        if (!User::where('email', $applicant->email)->exists()) {

            // Obtener partes del nombre
            $nombreCompleto = explode(' ', $applicant->full_name);

            $nombre     = isset($nombreCompleto[0]) ? substr($nombreCompleto[0], 0, 2) : 'no';
            $apellido1  = isset($nombreCompleto[1]) ? substr($nombreCompleto[1], 0, 2) : 'ap';
            $apellido2  = isset($nombreCompleto[2]) ? substr($nombreCompleto[2], 0, 2) : 'am';

            $passwordPlain = strtolower($nombre . $apellido1 . $apellido2);

            // Crear usuario
            User::create([
                'name' => $applicant->full_name,
                'email' => $applicant->email,
                'password' => Hash::make($passwordPlain),
                'role' => 'Scrum Master',
            ]);
        }

        return redirect()->back()->with('success', 'Postulante aceptado y credenciales creadas correctamente.');
    }

    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);
        // $applicant->delete();
        $applicant->status = 'denegado';
        $applicant->save();

        return redirect()->back()->with('success', 'Postulante eliminado correctamente.');
    }

    //funciones del/para dasboard del practicantes
    public function recuroScrum()
    {
        $user = Auth::user();
        return view('practicante.recursoscrum', compact('user'));
    }
    public function comunidad()
    {
        $users = User::where('role', 'Scrum Master')->get();
        return view('practicante.comunidad', compact('users'));
    }
    
}
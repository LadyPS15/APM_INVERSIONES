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
            'especializacion' => 'required|exists:specializations,id',
            'lenguajes' => 'nullable|array',
            'otros_lenguajes' => 'nullable|string|max:255',
            'disponibilidad' => 'required|string',
        ]);

        $applicant->specialization_id = $request->especializacion;
        $applicant->programming_languages = $request->lenguajes ? implode(',', $request->lenguajes) : null;
        $applicant->otros_lenguajes = $request->otros_lenguajes;
        $applicant->availability = $request->disponibilidad;
        $applicant->save();

        return redirect()->route('form.formularioMetodologia', ['applicant' => $applicant->id]);
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

    // Guardar respuestas preguntas 1-5 y redirigir a preguntas 6-10
    public function guardarEvaluacionScrum(Request $request, Applicant $applicant)
    {
        $request->validate([
            'p1' => 'required|array',
            'p2' => 'required|array',
            'p3' => 'required|array',
            'p4' => 'required|array',
            'p5' => 'required|array',
        ]);

        $scrumEval = $applicant->scrumEvaluation ?? new ScrumEvaluation();
        $scrumEval->applicant_id = $applicant->id;
        $scrumEval->answers_part1 = $request->only(['p1', 'p2', 'p3', 'p4', 'p5']);
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
            'p6' => 'required|array',
            'p7' => 'required|array',
            'p8' => 'required|array',
            'p9' => 'required|array',
            'p10' => 'required|array',
        ]);

        $scrumEval = $applicant->scrumEvaluation ?? new ScrumEvaluation();
        $scrumEval->applicant_id = $applicant->id;
        $scrumEval->answers_part2 = $request->only(['p6', 'p7', 'p8', 'p9', 'p10']);

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

    // Método para calcular puntaje total basado en respuestas
    protected function calcularPuntaje(ScrumEvaluation $eval)
    {
        $score = 0;
        $valores = [1 => 0.5, 2 => 1, 3 => 2]; // valor por cada respuesta

        $part1 = $eval->answers_part1 ?? [];
        $part2 = $eval->answers_part2 ?? [];

        foreach (array_merge($part1, $part2) as $preguntas) {
            foreach ($preguntas as $respuesta) {
                if (isset($valores[$respuesta])) {
                    $score += $valores[$respuesta];
                }
            }
        }

        // Normalizar puntaje máximo 10
        return round(min($score, 40) / 40 * 10, 1);
    }

    // Método para predecir rol Scrum basado en respuestas
    protected function predecirRolScrum(ScrumEvaluation $eval)
    {
        $part1 = $eval->answers_part1 ?? [];
        $part2 = $eval->answers_part2 ?? [];

        // Sumar valores para cada rol
        $sm = 0; // Scrum Master: preguntas 1,3,5,10
        foreach (['p1', 'p3', 'p5', 'p10'] as $p) {
            if (isset($part1[$p])) $sm += array_sum($part1[$p]);
            if (isset($part2[$p])) $sm += array_sum($part2[$p]);
        }

        $po = 0; // Product Owner: preguntas 2,4,7,9
        foreach (['p2', 'p4', 'p7', 'p9'] as $p) {
            if (isset($part1[$p])) $po += array_sum($part1[$p]);
            if (isset($part2[$p])) $po += array_sum($part2[$p]);
        }

        $dev = 0; // Development Team: preguntas 6,8
        foreach (['p6', 'p8'] as $p) {
            if (isset($part1[$p])) $dev += array_sum($part1[$p]);
            if (isset($part2[$p])) $dev += array_sum($part2[$p]);
        }

        $max = max($sm, $po, $dev);

        if ($max == $sm) return 'Scrum Master';
        if ($max == $po) return 'Product Owner';
        if ($max == $dev) return 'Development Team';

        return 'No definido';
    }

    public function resultadoGeneral(Applicant $applicant)
    {
        $score = 0;

        // 1. Ciclo académico (1 a 6) mapeamos linealmente a 0.5 a 2 puntos
        $score += min(max($applicant->academic_cycle, 1), 6) * (2 / 6);

        // 2. Especialización
        $score += $applicant->specialization_id ? 2 : 0;

        // 3. Lenguajes de programación
        $langsCount = 0;
        if ($applicant->programming_languages) {
            $langsCount = count(explode(',', $applicant->programming_languages));
        }
        $score += min($langsCount, 4) * (2 / 4);

        // 4. Disponibilidad horaria (simple ejemplo)
        $availabilityPoints = 0;
        $availability = strtolower($applicant->availability ?? '');
        if (str_contains($availability, 'mañana') || str_contains($availability, 'manana')) {
            $availabilityPoints = 1;
        } elseif (str_contains($availability, 'tarde')) {
            $availabilityPoints = 0.7;
        } elseif (str_contains($availability, 'noche')) {
            $availabilityPoints = 0.5;
        }
        $score += $availabilityPoints;

        // 5. Experiencia Scrum
        $score += ($applicant->experiencia_scrum === 'si') ? 1 : 0;

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
        $score = round(min($score, 10), 1);

        return view('results.resultado_general', [
            'applicant' => $applicant,
            'total_score' => $score,
        ]);
    }

}

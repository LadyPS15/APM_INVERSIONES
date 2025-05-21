<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
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

    public function evaluacionScrum(Applicant $applicant)
    {
        return view('examscrum.evaluacion', compact('applicant'));
    }

    public function guardarEvaluacionScrum(Request $request, Applicant $applicant)
    {
        // Aquí agregarás lógica para guardar respuestas y calcular puntaje
        return redirect()->route('resultado.scrum', ['applicant' => $applicant->id]);
    }

    public function resultadoScrum(Applicant $applicant)
    {
        return view('results.resultado_scrum', compact('applicant'));
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

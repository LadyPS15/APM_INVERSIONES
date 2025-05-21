<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Career;
use App\Models\ProgrammingLanguage;
use App\Models\Specialization;
use App\Models\Schedule;
use App\Models\ScrumRole;
use App\Models\EducationalInstitution;


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
            'nombres' => 'required|string|max:100',
            'email' => 'required|email|unique:applicants,email',
            'carrera' => 'required|exists:careers,id',  // Asegúrate de que 'carrera' sea un ID válido
            'ciclo' => 'required|integer|between:1,10',
        ]);

        $applicant = Applicant::create([
            'full_name' => $request->nombres,
            'email' => $request->email,
            'career_id' => $request->carrera,  // Guardar el career_id, no el nombre
            'academic_cycle' => $request->ciclo,
            'access_token' => uniqid('token_', true),
        ]);

        // Redirigir correctamente a la vista del perfil técnico
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
                'especializacion' => 'required|exists:specializations,id',  // Validar que el ID de especialización exista
                'lenguajes' => 'nullable|array',
                'otros_lenguajes' => 'nullable|string|max:255',
                'disponibilidad' => 'required|string',
            ]);

            $applicant->specialization_id = $request->especializacion; // Guardar el ID de especialización
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
        // Procesar respuestas y guardar puntuaciones aquí (según tu lógica)
        return redirect()->route('resultado.scrum', ['applicant' => $applicant->id]);
    }

    public function resultadoScrum(Applicant $applicant)
    {
        return view('results.resultado_scrum', compact('applicant'));
    }

    public function resultadoGeneral(Applicant $applicant)
    {
        return view('results.resultado_general', compact('applicant'));
    }
}

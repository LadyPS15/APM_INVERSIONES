<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Application extends Model
{
     use HasFactory;

    protected $fillable = [
        'applicant_id',
        'institution_id',
        'career_id',
        'academic_cycle',
        'specialization_id',
        'schedule_id',
        'agile_experience_months',
        'previous_role_id',
        'project_experience',
        'status',
        'general_score',
        'scrum_score',
        'assigned_role_id',
        'reviewer_id',
        'review_date',
    ];

    protected $casts = [
        'review_date' => 'datetime',
        'general_score' => 'decimal:1',
        'scrum_score' => 'decimal:1',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function institution()
    {
        return $this->belongsTo(educational_institutions::class, 'institution_id');
    }

    public function career()
    {
        return $this->belongsTo(Careers::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function previousRole()
    {
        return $this->belongsTo(ScrumRole::class, 'previous_role_id');
    }

    public function assignedRole()
    {
        return $this->belongsTo(ScrumRole::class, 'assigned_role_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function programmingLanguages()
    {
        return $this->belongsToMany(ProgrammingLanguage::class, 'application_programming_languages')
            ->withPivot('proficiency_level');
    }

    public function evaluationAnswers()
    {
        return $this->hasMany(EvaluationAnswer::class);
    }

    // Calcular las puntuaciones en función de las respuestas de la evaluación
    public function calculateScores()
    {
        // Calcular la puntuación general (promedio de todas las respuestas)
        $generalAnswers = $this->evaluationAnswers;
        if ($generalAnswers->count() > 0) {
            $generalScore = $generalAnswers->avg('points_earned');
            $this->general_score = round($generalScore, 1);
        }
        
        // Calcular la puntuación específica de Scrum (promedio de las respuestas de la categoría de Scrum)
        $scrumAnswers = $this->evaluationAnswers()
            ->whereHas('question', function ($query) {
                $query->where('category', 'Scrum');
            })
            ->get();
            
        if ($scrumAnswers->count() > 0) {
            $scrumScore = $scrumAnswers->avg('points_earned');
            $this->scrum_score = round($scrumScore, 1);
        }
        
        $this->save();
    }

    // Recommend a role based on scores
    public function recommendRole()
    {
        // Obtener la configuración de puntuación
        $config = ScoringConfiguration::first();
        
        // Si el solicitante no cumple con el puntaje mínimo para la aprobación, no le asigne un rol
        if ($this->general_score < $config->min_score_for_approval) {
            return null;
        }
        
        // Obtenga todos los requisitos del rol
        $requirements = RoleRequirement::with('role')->get();
        
        $bestRoleId = null;
        $bestScore = -1;
        
        foreach ($requirements as $requirement) {
            // Verifique si el solicitante cumple con los requisitos mínimos para este puesto
            if ($this->general_score >= $requirement->min_general_score && 
                $this->scrum_score >= $requirement->min_scrum_score) {
                
                // Calcular una puntuación ponderada para este rol
                $score = ($this->scrum_score * $config->scrum_evaluation_weight) + 
                         ($this->general_score * $config->technical_evaluation_weight);
                
                //Añadir bono si el solicitante tiene la especialización preferida
                if ($requirement->preferred_specialization_id == $this->specialization_id) {
                    $score += 1.0;
                }
                
                // Seguimiento de la mejor coincidencia de roles
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestRoleId = $requirement->role_id;
                }
            }
        }
        
        $this->assigned_role_id = $bestRoleId;
        $this->save();
        
        return $bestRoleId;
    }
}
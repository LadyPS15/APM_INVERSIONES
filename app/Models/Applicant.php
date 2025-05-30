<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'career_id',
        'academic_cycle',
        'access_token',
        'specialization_id',
        'other_specialization',
        'programming_languages',
        'availability',
        'schedule_id',
        'scrum_role_id',
        'otros_lenguajes',
        'experiencia_scrum',
        'tiempo_experiencia',
        'tipo_proyectos',
        'rol_principal',
        'scrum_score',
        'status',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function scrumRole()
    {
        return $this->belongsTo(ScrumRole::class);
    }

   public function scrumEvaluation()
    {
        return $this->hasOne(ScrumEvaluation::class);
    }


    // Generar un token de acceso único para el solicitante
    public function generateAccessToken($academicCycle)
    {
        $baseToken = strtolower(str_replace(' ', '', $this->full_name)) . '_' . str_replace(' ', '', $academicCycle);
        $token = $baseToken . '_' . substr(md5(uniqid(rand(), true)), 0, 8);

        $this->access_token = $token;
        $this->save();

        return $token;
    }
}
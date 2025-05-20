<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleRequirement extends Model
{
    use HasFactory;

    protected $table = 'role_requirements';

    protected $fillable = [
        'role_id',
        'min_scrum_score',
        'min_general_score',
        'preferred_specialization_id',
    ];

    protected $casts = [
        'min_scrum_score' => 'decimal:1',
        'min_general_score' => 'decimal:1',
    ];

    public function role()
    {
        return $this->belongsTo(ScrumRole::class, 'role_id');
    }

    public function preferredSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'preferred_specialization_id');
    }

    //Verifica si se cumple este requisito dado el puntaje de Scrum, general y una especialización.

    public function isSatisfiedBy(float $scrumScore, float $generalScore, ?int $specializationId = null): bool
    {
        $scoresOk = $scrumScore >= $this->min_scrum_score && $generalScore >= $this->min_general_score;

        $specializationOk = is_null($this->preferred_specialization_id) ||
        $this->preferred_specialization_id === $specializationId;

        return $scoresOk && $specializationOk;
    }
}

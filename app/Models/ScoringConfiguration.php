<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoringConfiguration extends Model
{
    use HasFactory;

    protected $table = 'scoring_configuration'; // Nombre de la tabla asociada al modelo

    protected $fillable = [
        'min_score_for_approval',
        'role_assignment_algorithm',
        'scrum_evaluation_weight',
        'technical_evaluation_weight',
    ];

    protected $casts = [
        'min_score_for_approval' => 'decimal:1',
        'scrum_evaluation_weight' => 'decimal:1',
        'technical_evaluation_weight' => 'decimal:1',
    ];


    public function totalWeight(): float
    {
        return $this->scrum_evaluation_weight + $this->technical_evaluation_weight;
    }

    // Verifica si la configuración es válida (el peso total de las evaluaciones es 1)
    public function isValidConfiguration(): bool
    {
        return round($this->totalWeight(), 1) === 1.0;
    }

        // Scope para obtener la configuración activa
    public function scopeActive($query)
    {
        return $query->orderByDesc('created_at')->limit(1);
    }

    //Define los algoritmos disponibles para asignación de roles.
    public static function algorithms(): array
    {
        return ['weighted_score', 'scrum_priority'];
    }
}

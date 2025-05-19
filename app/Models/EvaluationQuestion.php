<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationQuestion extends Model
{
    use HasFactory;

    protected $table = 'evaluation_questions'; // Nombre de la tabla asociada al modelo

    protected $fillable = [
        'question',
        'category',
    ];

    // Constantes de categoría
    public const CATEGORY_SCRUM = 'Scrum';
    public const CATEGORY_TECHNICAL = 'Technical';
    public const CATEGORY_SOFT_SKILLS = 'Soft Skills';


    // Lista de categorías válidas
    public static function categories(): array
    {
        return [
            self::CATEGORY_SCRUM,
            self::CATEGORY_TECHNICAL,
            self::CATEGORY_SOFT_SKILLS,
        ];
    }

    // Relación: una pregunta tiene muchas opciones
    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    // Relación: una pregunta tiene muchas respuestas
    public function answers()
    {
        return $this->hasMany(EvaluationAnswer::class, 'question_id');
    }

    // Scope: filtrar por categoría
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Validación interna
    public function isValid(): bool
    {
        return !empty(trim($this->question)) && !empty($this->category);
    }

    // Promedio de puntaje obtenido en esta pregunta
    public function averageScore()
    {
        return $this->answers()->avg('points_earned');
    }
}

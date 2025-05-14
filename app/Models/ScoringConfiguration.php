<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoringConfiguration extends Model
{
    use HasFactory;

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
}

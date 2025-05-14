<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'question_id',
        'selected_option_id',
        'points_earned',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function question()
    {
        return $this->belongsTo(EvaluationQuestion::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }
}
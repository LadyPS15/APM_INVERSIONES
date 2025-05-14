<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'category',
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(EvaluationAnswer::class, 'question_id');
    }
}
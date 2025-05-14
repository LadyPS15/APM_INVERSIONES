<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_text',
        'points',
    ];

    public function question()
    {
        return $this->belongsTo(EvaluationAnswer::class, 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(EvaluationAnswer::class, 'selected_option_id');
    }
}
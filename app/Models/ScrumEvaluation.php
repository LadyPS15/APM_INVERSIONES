<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrumEvaluation extends Model
{
    protected $fillable = [
        'applicant_id',
        'answers_part1',
        'answers_part2',
        'score',
        'predicted_role',
    ];

    protected $casts = [
        'answers_part1' => 'array',
        'answers_part2' => 'array',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

}

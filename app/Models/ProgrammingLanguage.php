<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgrammingLanguage extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function applications()
    {
        return $this->belongsToMany(Applicant::class, 'applicaticant')
            ->withPivot('proficiency_level');
    }
}

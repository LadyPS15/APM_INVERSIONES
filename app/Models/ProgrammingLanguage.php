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
        return $this->belongsToMany(Application::class, 'application_programming_languages')
            ->withPivot('proficiency_level');
    }
}

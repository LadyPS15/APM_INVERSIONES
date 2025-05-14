<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationProgrammingLanguage extends Model
{
    use HasFactory;
    
    protected $table = 'application_programming_languages';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    
    protected $fillable = [
        'application_id',
        'programming_language_id',
        'proficiency_level'
    ];
}

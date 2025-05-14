<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function roleRequirements()
    {
        return $this->hasMany(RoleRequirement::class, 'preferred_specialization_id');
    }
}


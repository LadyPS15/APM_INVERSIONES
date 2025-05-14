<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'min_scrum_score',
        'min_general_score',
        'preferred_specialization_id',
    ];

    protected $casts = [
        'min_scrum_score' => 'decimal:1',
        'min_general_score' => 'decimal:1',
    ];

    public function role()
    {
        return $this->belongsTo(ScrumRole::class);
    }

    public function preferredSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'preferred_specialization_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScrumRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function applicationsPreviousRole()
    {
        return $this->hasMany(Application::class, 'previous_role_id');
    }

    public function applicationsAssignedRole()
    {
        return $this->hasMany(Application::class, 'assigned_role_id');
    }

    public function roleRequirements()
    {
        return $this->hasMany(RoleRequirement::class, 'role_id');
    }

    public function roleResources()
    {
        return $this->hasMany(RoleResource::class, 'role_id');
    }
}

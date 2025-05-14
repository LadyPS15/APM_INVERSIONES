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

    public function applicationsWithPreviousRole()
    {
        return $this->hasMany(Application::class, 'previous_role_id');
    }

    public function applicationsWithAssignedRole()
    {
        return $this->hasMany(Application::class, 'assigned_role_id');
    }

    public function resources()
    {
        return $this->hasMany(RoleResource::class, 'role_id');
    }

    public function requirements()
    {
        return $this->hasOne(RoleRequirement::class, 'role_id');
    }
}

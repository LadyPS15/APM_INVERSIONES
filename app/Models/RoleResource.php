<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleResource extends Model
{
   use HasFactory;

    protected $fillable = [
        'role_id',
        'title',
        'description',
        'resource_type',
        'file_path',
        'external_link',
    ];

    public function role()
    {
        return $this->belongsTo(ScrumRole::class, 'role_id');
    }

    public function resourceAccesses()
    {
        return $this->hasMany(ResourceAccess::class, 'resource_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'access_token',
    ];

     public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function resourceAccesses()
    {
        return $this->hasMany(ResourceAccess::class);
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'user');
    }

    // Generar un token de acceso único para el solicitante
    public function generateAccessToken($academicCycle)
    {
        // Crear un token basado en nombre y ciclo académico
        $baseToken = strtolower(str_replace(' ', '', $this->full_name)) . '_' . str_replace(' ', '', $academicCycle);
        $token = $baseToken . '_' . substr(md5(uniqid(rand(), true)), 0, 8);
        
        $this->access_token = $token;
        $this->save();
        
        return $token;
    }
}
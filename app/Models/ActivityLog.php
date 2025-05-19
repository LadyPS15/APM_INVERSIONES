<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Atributos que se pueden asignar de manera masiva
    protected $fillable = [
        'user_type',
        'user_id',
        'action_type',
        'description',
        'ip_address',
    ];

     // Conversión automática del campo created_at a tipo datetime
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relación polimórfica con el usuario que realizó la acción
    public function user()
    {
        return $this->morphTo();
    }
}



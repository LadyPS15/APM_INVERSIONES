<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\Factories\HasFactory;

class Careers extends Model
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
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

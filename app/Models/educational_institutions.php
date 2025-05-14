<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class educational_institutions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'agreement_date',
        'agreement_status',
    ];

    protected $casts = [
        'agreement_date' => 'date',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'institution_id');
    }
}

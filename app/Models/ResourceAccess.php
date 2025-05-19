<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResourceAccess extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'resource_id',
        'access_date',
    ];

    protected $casts = [
        'access_date' => 'datetime',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function resource()
    {
        return $this->belongsTo(RoleResource::class, 'resource_id');
    }

    public function scopeForApplicant($query, int $applicantId)
{
    return $query->where('applicant_id', $applicantId);
}

public function scopeRecent($query)
{
    return $query->orderByDesc('access_date');
}


}

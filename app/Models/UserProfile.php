<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_position_id',
        'gender',
        'birthday',
        'city',
        'country_id',
        'address',
        'phone',
        'mobile',
    ];

    public function job_position(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}

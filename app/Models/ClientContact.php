<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'phone',
        'job_title',
        'email',
    ];

    public function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->first_name . ' ' . $this->last_name
        );
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

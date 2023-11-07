<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Database extends Model
{
    use HasFactory;

    public function logins(): MorphMany
    {
        return $this->morphMany(Login::class, 'loginable');
    }

    public function databaseType(): BelongsTo
    {
        return $this->belongsTo(DatabaseType::class);
    }
}

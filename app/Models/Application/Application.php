<?php

namespace App\Models\Application;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    public function databases(): HasMany
    {
        return $this->hasMany(Database::class);
    }
}

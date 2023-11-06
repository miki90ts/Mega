<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Login extends Model
{
    protected $fillable = [
        'username',
        'password'
    ];
    public function loginable(): MorphTo
    {
        return $this->morphTo();
    }
}

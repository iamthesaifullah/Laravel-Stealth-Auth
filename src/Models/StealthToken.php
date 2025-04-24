<?php

namespace StealthAuth\Models;

use Illuminate\Database\Eloquent\Model;

class StealthToken extends Model
{
    protected $fillable = [
        'user_id', 'token', 'expires_at', 'uses', 'max_uses'
    ];

    protected $dates = ['expires_at'];
}

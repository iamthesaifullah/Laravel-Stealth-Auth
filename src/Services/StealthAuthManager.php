<?php

namespace StealthAuth\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use StealthAuth\Models\StealthToken;
use Carbon\Carbon;

class StealthAuthManager
{
    public function forUser($user, $ttl = null, $maxUses = 1)
    {
        $token = Str::random(40);
        $expiresAt = Carbon::now()->addMinutes($ttl ?? config('stealth-auth.token_lifetime'));

        StealthToken::create([
            'user_id' => $user->id,
            'token' => config('stealth-auth.encryption') ? Crypt::encrypt($token) : $token,
            'expires_at' => $expiresAt,
            'max_uses' => $maxUses,
        ]);

        return $token;
    }
}

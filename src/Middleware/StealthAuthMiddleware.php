<?php

namespace StealthAuth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use StealthAuth\Models\StealthToken;
use Carbon\Carbon;

class StealthAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');

        $record = StealthToken::where('token', $token)->first();

        if (! $record || Carbon::now()->greaterThan($record->expires_at) ||
            ($record->max_uses !== null && $record->uses >= $record->max_uses)) {
            abort(403, 'Unauthorized.');
        }

        $record->increment('uses');

        if ($record->user_id) {
            Auth::loginUsingId($record->user_id);
        }

        return $next($request);
    }
}
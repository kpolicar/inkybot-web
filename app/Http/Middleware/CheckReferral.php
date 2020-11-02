<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckReferral
{
    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('referral')) {
            return $next($request);
        }

        if (($ref = $request->query('ref')) && User::findByReferral($ref)->exists) {
            return redirect($request->fullUrl())->withCookie(cookie()->forever('referral', $ref));
        }

        return $next($request);
    }
}

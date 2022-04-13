<?php

namespace App\Http\Middleware;

use App\Models\Maging;
use Closure;
use Illuminate\Http\Request;

class UpdateMagingIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Maging::saving(function ($maging) use ($request) {
            $maging->ip_address = $request->ip() ?: $maging->ip_address;
        });
        return $next($request);
    }
}

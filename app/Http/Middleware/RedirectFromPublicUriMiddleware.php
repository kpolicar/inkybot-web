<?php

namespace App\Http\Middleware;

use Str;
use URL;
use Closure;
use Illuminate\Http\Request;

class RedirectFromPublicUriMiddleware
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
        if (Str::startsWith(Str::lower($request->getBaseUrl()), '/public')) {
            return redirect()->to(URL::current(), 307);
        }
        if (Str::startsWith(Str::lower($request->getBaseUrl()), '/index.php')) {
            return redirect()->to(URL::current(), 307);
        }

        return $next($request);
    }
}

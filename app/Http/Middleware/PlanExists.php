<?php

namespace App\Http\Middleware;

use App\Billing;
use Closure;
use Illuminate\Http\Request;

class PlanExists
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
        if ($plan = $request->get('plan')) {
            rescue(function () use ($plan) {
                Billing::resolvePlan($plan);
            }, function () {
                abort(404);
            });
        }
        return $next($request);
    }
}

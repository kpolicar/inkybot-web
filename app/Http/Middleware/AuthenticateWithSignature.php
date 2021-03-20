<?php

namespace App\Http\Middleware;

use Str;
use App\Contracts\ApiEncrypter;
use Closure;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class AuthenticateWithSignature
{
    private $crypt;

    public function __construct(Container $container)
    {
        $this->crypt = $container->get(ApiEncrypter::class);
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $signature = $request->header('Authorization-Signature');
        if (!$signature)
            abort(401);
        $decrypted = $this->crypt->decryptString($signature);

        $key = config('app.api_key');
        if (Str::startsWith($key, 'base64:')) {
            $key = substr($key, 7);
        }

        $matches = $decrypted == $key;
        if (!$matches)
            abort(401);

        return $next($request);
    }
}

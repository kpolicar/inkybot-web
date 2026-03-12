<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CaptureGoogleAnalyticsClientId
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            if ($request->user() && empty($request->user()->ga_client_id)) {
                $clientId = $this->extractClientId($request);
                if ($clientId) {
                    $request->user()->forceFill(['ga_client_id' => $clientId])->saveQuietly();
                }
            }
        } catch (\Throwable $e) {
            Log::warning('GA4: Failed to capture client ID: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * @return string|null
     */
    private function extractClientId(Request $request)
    {
        $gaCookie = $request->cookie('_ga');
        if ($gaCookie && preg_match('/GA\d+\.\d+\.(.+)$/', $gaCookie, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

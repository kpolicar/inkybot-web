<?php

namespace App\Listeners;

use App\Services\GoogleAnalytics;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendRegistrationToGoogleAnalytics implements ShouldQueue
{
    public $tries = 2;

    public function handle(Registered $event)
    {
        $user = $event->user;

        if (empty($user->ga_client_id)) {
            return;
        }

        app(GoogleAnalytics::class)->sendRegistrationEvent($user);
    }

    public function failed(Registered $event, \Throwable $exception)
    {
        Log::warning('GA4: Registration event failed for user ' . $event->user->id . ': ' . $exception->getMessage());
    }
}

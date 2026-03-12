<?php

namespace App\Listeners;

use App\Events\UserPurchasedSubscription;
use App\Services\GoogleAnalytics;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendPurchaseToGoogleAnalytics implements ShouldQueue
{
    public $tries = 2;

    public function handle(UserPurchasedSubscription $event)
    {
        $user = $event->user;

        if (empty($user->ga_client_id)) {
            return;
        }

        app(GoogleAnalytics::class)->sendPurchaseEvent($user);
    }

    public function failed(UserPurchasedSubscription $event, \Throwable $exception)
    {
        Log::warning('GA4: Purchase event failed for user ' . $event->user->id . ': ' . $exception->getMessage());
    }
}

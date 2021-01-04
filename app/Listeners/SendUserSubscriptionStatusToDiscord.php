<?php

namespace App\Listeners;

use App\Events\UserEvent;
use App\Events\UserPurchasedSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserSubscriptionStatusToDiscord
{
    /**
     * Handle the event.
     *
     * @param  UserEvent  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $user = $event->user;
        if ($user->wasChanged('discord_id') && $previousId = $user->getOriginal('discord_id')) {
            $content = "!unsubscribe {$previousId}";
            \Http::post(
                config('discord.webhook_url'),
                compact('content')
            );
        }

        $command = $user->is_subscribed
            ? "subscribe"
            : "unsubscribe";
        $content = "!$command {$user->discord_id}";
        \Http::post(
            config('discord.webhook_url'),
            compact('content')
        );
    }
}

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

        if ($id = $user->discord_id) {
            $command = $user->subscribed()
                ? "subscribe"
                : "unsubscribe";
            $content = "!$command {$id}";
            \Http::post(
                config('discord.webhook_url'),
                compact('content')
            );
        }
    }
}

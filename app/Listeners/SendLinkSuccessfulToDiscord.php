<?php

namespace App\Listeners;

use App\Events\UserEvent;
use App\Events\UserPurchasedSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLinkSuccessfulToDiscord
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

        $content = "!linked {$user->discord_id}";
        \Http::post(
            config('discord.webhook_url'),
            compact('content')
        );
    }
}

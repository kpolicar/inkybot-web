<?php

namespace App\Listeners;

use App\Events\MagePublishUploaded;

class SendMagePublishToDiscord
{
    public function handle(MagePublishUploaded $event)
    {
        $user = optional($event->magePublish->user);
        if (!$user->optin_discord_notifications)
            return;

        $imagePath = asset($event->magePublish->image_path);
        $content = "!notify {$user->discord_id} \"$imagePath\"";
        \Http::post(
            config('discord.webhook_url'),
            compact('content')
        );
    }
}

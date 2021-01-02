<?php

namespace App\Observers;

use App\Events\UserSyncedWithDiscord;
use App\Models\User;

class UserObserver
{
    public function updated(User $user)
    {
        if ($user->wasChanged('discord_id')) {
            UserSyncedWithDiscord::dispatch($user);
        }
    }
}

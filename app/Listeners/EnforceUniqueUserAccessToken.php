<?php

namespace App\Listeners;

use DB;
use Laravel\Passport\Events\AccessTokenCreated;

class EnforceUniqueUserAccessToken
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $event->userId)
            ->where('id', '!=', $event->tokenId)
            ->update([
                'revoked' => 1
            ]);
    }
}

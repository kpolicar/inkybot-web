<?php

namespace App\Listeners;

use App\Models\User;
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
        $user = User::find($event->userId);
        if (!$user)
            return;

        $token = $user->tokens()->firstWhere('id', $event->tokenId);
        if ($token->name == null) {
            $user->tokens()
                ->where('id', '!=', $event->tokenId)
                ->delete();
            return;
        }

        $skip = max(optional($user->validSubscription())->quantity - 1, 0);
        $tokensToDelete = $user->tokens()
            ->where('name', '!=', $token->name)
            ->get()
            ->groupBy('name')
            ->skip($skip)
            ->flatten();


        if ($tokensToDelete->isNotEmpty()) {

            // Look again
            sleep(1);
            $tokensToDelete = $user->tokens()
                ->where('name', '!=', $token->name)
                ->get()
                ->groupBy('name')
                ->skip($skip)
                ->flatten();
            if ($tokensToDelete->isEmpty()) {
                return;
            }


            \Log::info("Deleting tokens for user {$user->id} with email {$user->email}");
            \Log::info("All tokens:");
            \Log::info($user->tokens()->get()->pluck('name'));
            \Log::info("Deleting these tokens:");
            \Log::info($tokensToDelete->pluck('name'));


            \DB::table('oauth_refresh_tokens')->whereIn('access_token_id', $tokensToDelete->pluck('id'))->delete();
            \DB::table('oauth_access_tokens')->whereIn('id', $tokensToDelete->pluck('id'))->delete();
        }
    }
}

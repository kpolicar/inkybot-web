<?php

namespace App\Listeners;

use App\Events\UserPurchasedSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RewardUserReferrer
{
    /**
     * Handle the event.
     *
     * @param  UserPurchasedSubscription  $event
     * @return void
     */
    public function handle(UserPurchasedSubscription $event)
    {
        $referrer = optional($event->user->referrer);
        if ($referrer->exists && !$referrer->received_referral_reward) {
            $referrer
                ->forceFill([
                    'subscribed_to' => $referrer->ExtendedSubscriptionDateForReferral(),
                    'received_referral_reward' => 1,
                ])
                ->save();
        }
    }
}

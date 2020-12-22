<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Laravel\Cashier\Subscription;
use Stripe\Subscription as StripeSubscription;

class WebhookController extends CashierController
{
    protected function handlePaymentIntentSucceeded(array $payload)
    {
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            $success = $user
                ->forceFill(['subscribed_to' => $user->ExtendedSubscriptionDate()])
                ->save();

            $referrer = optional($user->referrer);
            if ($success && $referrer->exists && !$referrer->received_referral_reward) {
                $referrer
                    ->forceFill([
                        'subscribed_to' => $referrer->ExtendedSubscriptionDateForReferral(),
                        'received_referral_reward' => 1,
                    ])
                    ->save();
            }
        }

        return $this->successMethod();
    }
}

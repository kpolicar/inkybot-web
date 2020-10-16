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
            $extendedDate = $user->subscribed_to ?? $user->freshTimestamp();
            $extendedDate = $extendedDate->maximum($user->freshTimestamp());
            $extendedDate = $extendedDate->addMonth();

            $user->forceFill(['subscribed_to' => $extendedDate])
                ->save();
        }

        return $this->successMethod();
    }
}

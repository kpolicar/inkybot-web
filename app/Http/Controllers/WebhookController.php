<?php

namespace App\Http\Controllers;

use App\Events\UserPurchasedSubscription;
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

            if ($success)
                UserPurchasedSubscription::dispatch($user);
        }

        return $this->successMethod();
    }
}

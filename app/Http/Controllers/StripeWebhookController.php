<?php

namespace App\Http\Controllers;

use App\Events\UserPurchasedSubscription;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    protected function handleCustomerSubscriptionCreated(array $payload)
    {
        $response = parent::handleCustomerSubscriptionCreated($payload);

        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            UserPurchasedSubscription::dispatch($user);
        }

        return $response;
    }

    public function handlePaymentIntentSucceeded()
    {
        
    }
}

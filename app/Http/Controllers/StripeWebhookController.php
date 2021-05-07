<?php

namespace App\Http\Controllers;

use App\Events\PaymentSucceeded;
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

    protected function handleCustomerUpdated(array $payload)
    {
        $response = parent::handleCustomerUpdated($payload);

        if ($user = $this->getUserByStripeId($payload['data']['object']['id'])) {
            $user->stripe_balance = $payload['data']['object']['balance'];
            $user->save();
        }

        return $response;
    }


    protected function handlePaymentIntentSucceeded(array $payload)
    {
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            $data = $payload['data']['object'];

            $paymentData = [
                'user_id' => $user->id,
                'source' => 'stripe',
                'transaction_id' => $data['id'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
            ];

            PaymentSucceeded::dispatch($paymentData);
        }

        return $this->successMethod();
    }
}

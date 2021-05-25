<?php

namespace App\Http\Controllers;

use App\Events\PaymentSucceeded;
use App\Events\UserPurchasedSubscription;
use Carbon\Carbon;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    protected function handleCustomerSubscriptionCreated(array $payload)
    {
        $response = parent::handleCustomerSubscriptionCreated($payload);

        $user = $this->getUserByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $this->updateUserSubscriptionWithAdditionalValues($payload, $user);
            UserPurchasedSubscription::dispatch($user);
        }

        return $response;
    }

    protected function handleCustomerSubscriptionUpdated(array $payload)
    {
        $response = parent::handleCustomerSubscriptionUpdated($payload);
        $this->updateUserSubscriptionWithAdditionalValues($payload);

        return $response;
    }

    protected function handleCustomerUpdated(array $payload)
    {
        $response = parent::handleCustomerUpdated($payload);

        if ($user = $this->getUserByStripeId($payload['data']['object']['id'])) {
            $user->stripe_balance = (int)$payload['data']['object']['balance'];
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

    protected function updateUserSubscriptionWithAdditionalValues($payload, $user=null)
    {
        $user = $user ?: $this->getUserByStripeId($payload['data']['object']['customer']);
        if (!$user)
            return;
        $subscription = $user->subscriptions->where('stripe_id', $payload['data']['object']['id'])->first();
        if ($subscription) {
            $subscription->current_period_end = Carbon::createFromTimestamp($payload['data']['object']['current_period_end']);
            $subscription->save();
        }
    }
}

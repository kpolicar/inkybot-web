<?php

namespace App\Http\Controllers;

use App\Events\UserPurchasedSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Laravel\Cashier\Invoice;
use Laravel\Cashier\Subscription;
use Stripe\Subscription as StripeSubscription;

class StripeWebhookController extends CashierController
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

    protected function handleInvoicePaid(array $payload) {
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        if ($user) {
            $data = $payload['data']['object'];
            $priceIds = data_get($data, 'lines.data.*.price.id', []);

            if (in_array(config('cashier.product_price_single_id'), $priceIds)) {
                // Todo
            }

        }

        return $this->successMethod();
    }

}

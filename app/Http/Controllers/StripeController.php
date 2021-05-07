<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Stripe\Exception\ApiErrorException;
use Stripe\Invoice as StripeInvoice;
use Stripe\InvoiceItem;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class StripeController extends BillingController
{
    public function subscribe(Request $request, $paymentMethodId) {
        $this->validateQuantity($request);

        $user = $request->user();
        $totalCost = $this->price($request);

        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();

        try {
            $paymentMethod = $this->uniqueCustomerPaymentMethod($user, $paymentMethodId);
            $this->createNewSubscription($request, $user, $request->post('plan'), $paymentMethod ?? null);

        } catch (PaymentFailure $e) {
            dd($e);
            // Todo
        } catch (PaymentActionRequired $e) {
            return [
                "redirect" => route(
                    'cashier.payment',
                    [$e->payment->id, 'redirect' => route('profile')],
                )
            ];
        } catch (ApiErrorException $e) {
            dd($e);
            // Todo
        }


        $plan = $request->input('plan');
        $quantity = $this->quantityFromPost($request);

        $package = __('pricing.package_'.$plan);
        $description = trans_choice('pricing.plan', $quantity, compact('quantity', 'package'));

        return response()->view('partials.payment.success', compact('totalCost', 'description'));
    }

    private function createNewSubscription(Request $request, User $user, $plan, PaymentMethod $paymentMethod)
    {
        $subscription = $user->newSubscription('default', Billing::resolvePlan($plan))
            ->noProrate()
            ->create($paymentMethod);
        if (!$request->post('recurring', false))
            $subscription->cancel();
    }

    private function uniqueCustomerPaymentMethod(User $user, $paymentMethodId) {
        $paymentMethod = PaymentMethod::retrieve($paymentMethodId, $user->stripeOptions());

        $existingPaymentMethod = $user->paymentMethods()
            ->map->asStripePaymentMethod()
            ->firstWhere('card.fingerprint', $paymentMethod->card->fingerprint);

        if (!$existingPaymentMethod) {
            $existingPaymentMethod = $user->addPaymentMethod($paymentMethod)->asStripePaymentMethod();
        }

        return $existingPaymentMethod;
    }
}

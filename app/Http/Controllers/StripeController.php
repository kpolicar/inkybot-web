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

class StripeController extends Controller
{
    private function createNewSubscription(Request $request, User $user, PaymentMethod $paymentMethod)
    {
        $customer = $user->asStripeCustomer();
        $customer->balance = 1500;
        $customer->save();

        $user->newSubscription('default', Billing::resolvePlan('standard'))
            ->noProrate()
            ->withMetadata([
                'coinbase_charge_id' => 2
            ])
            ->withCoupon(config('cashier.coupon_paid_by_coinbase'))
            ->create()
            ->cancel();
    }

    public function subscribe(Request $request, PaymentMethod $paymentMethodId) {
        $user = $request->user();

        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();


        try {
            //$paymentMethod = $this->uniqueCustomerPaymentMethod($user, $paymentMethodId);
            $this->createNewSubscription($request, $user, $paymentMethod ?? null);

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

        return response()->view('partials.payment.success');
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

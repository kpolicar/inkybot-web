<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Stripe\Exception\ApiErrorException;
use Stripe\Invoice as StripeInvoice;
use Stripe\InvoiceItem;
use Stripe\PaymentMethod;

class StripeController extends Controller
{
    public function subscribe(Request $request, $paymentMethodId) {
        $user = $request->user();

        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();

        try {

            if (false && $request->post('recurring', false)) {
                if (optional($user->subscription())->recurring())
                    abort(400);
                $checkout = $this->recurringCharge($user, $paymentMethodId);
            } else {
                $checkout = $this->singleCharge($user, $paymentMethodId);
            }

        } catch (PaymentFailure $e) {
            // Todo
        } catch (PaymentActionRequired $e) {
            return [
                "redirect" => route(
                    'cashier.payment',
                    [$e->payment->id, 'redirect' => route('profile')],
                )
            ];
        } catch (ApiErrorException $e) {
            // Todo
        }

        return response()->view('partials.payment.success');
    }

    /**
     * @param User $user
     * @param $paymentMethodId
     * @throws PaymentActionRequired
     * @throws PaymentFailure
     */
    private function recurringCharge(User $user, $paymentMethodId) {
        $paymentMethod = $this->uniqueCustomerPaymentMethod($user, $paymentMethodId);

        $user->newSubscription('default', config('cashier.product_price_recurring_id'))
            ->anchorBillingCycleOn($user->subscribed_to->getTimestamp())
            ->create($paymentMethod);
    }

    /**
     * @param User $user
     * @param $paymentMethodId
     * @throws ApiErrorException
     */
    private function singleCharge(User $user, $paymentMethodId) {
        $stripeInvoiceItem = null;
        $stripeInvoice = null;

        try {
            $paymentMethod = $this->uniqueCustomerPaymentMethod($user, $paymentMethodId);

            $stripeInvoiceItem = InvoiceItem::create([
                'customer' => $user->stripeId(),
                'price' => config('cashier.product_price_single_id'),
            ], $user->stripeOptions());

            $stripeInvoice = StripeInvoice::create([
                'customer' => $user->stripeId(),
                'collection_method' => StripeInvoice::COLLECTION_METHOD_CHARGE_AUTOMATICALLY,
            ], $user->stripeOptions());

        } catch (ApiErrorException $e) {
            optional($stripeInvoiceItem)->delete();
            optional($stripeInvoice)->delete();
            throw $e;
        }

        try {
            $stripeInvoice->pay([
                'payment_method' => $paymentMethod->id,
            ]);
        } catch (ApiErrorException $e) {
            $stripeInvoice->markUncollectible();
            throw $e;
        }
    }

    private function uniqueCustomerPaymentMethod(User $user, $paymentMethodId) {
        $paymentMethod = PaymentMethod::retrieve($paymentMethodId, $user->stripeOptions());

        $existingPaymentMethod = $user->paymentMethods()
            ->map->asStripePaymentMethod()
            ->firstWhere('card.fingerprint', $paymentMethod->card->fingerprint);

        if (!$existingPaymentMethod) {
            $existingPaymentMethod = $user->addPaymentMethod($paymentMethod);
        }

        return $existingPaymentMethod;
    }
}

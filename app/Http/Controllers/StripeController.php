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

        $plan = $this->plan($request);

        try {
            $paymentMethod = $this->uniqueCustomerPaymentMethod($user, $paymentMethodId);
            $this->createNewSubscription($request, $user, $plan, $paymentMethod ?? null, $request->post('promocode'));

        } catch (PaymentFailure $exception) {
            return response()->view('partials.payment.failed', compact('exception'));
            // Todo
        } catch (PaymentActionRequired $exception) {
            return [
                "redirect" => route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('profile')],
                )
            ];
        } catch (ApiErrorException $exception) {
            return response()->view('partials.payment.failed', compact('exception'));
        }


        $quantity = $this->quantityFromPost($request);

        $package = __('pricing.package_'.$plan);
        $description = trans_choice('pricing.plan', $quantity, compact('quantity', 'package'));

        return response()->view('partials.payment.success', compact('totalCost', 'description'));
    }

    public function applyPromo(Request $request)
    {
        $plans = [
            Billing::starterPlan() => 'STARTERBLACKFRIDAY2021',
            Billing::standardPlan() => 'STANDARDBLACKFRIDAY2021',
            Billing::unlimitedPlan() => 'UNLIMITEDBLACKFRIDAY2021',
            Billing::unlimitedWithQueuePlan() => 'UNLIMITEDBLACKFRIDAY2021',
        ];
        $currentPlanCode = data_get($plans, $request->user()->subscription()->stripe_plan);

        if ($request->user()->hasDiscountedSubscription($currentPlanCode)) {
            abort(400);
        }

        $coupon = $this->promoCodeToCouponId($currentPlanCode);
        $sub = $request->user()->subscription()->asStripeSubscription();
        \DB::table('subscription_discounts')->insert([
            'subscription_id' => $request->user()->subscription()->id,
            'promocode' => $currentPlanCode,
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        $sub->coupon = $coupon;
        $sub->save();

        return redirect('profile');
    }

    private function createNewSubscription(Request $request, User $user, $plan, PaymentMethod $paymentMethod, $promocode='')
    {
        $subscription = $user->newSubscription('default', Billing::resolvePlan($plan))
            ->quantity($this->quantityFromPost($request))
            ->noProrate()
            ->withPromotionCode($this->promoCodeToId($promocode))
            ->create($paymentMethod);

        if (!$request->post('recurring', false))
            $subscription->cancel();

        if ($this->promoCodeToId($promocode)) {
            \DB::table('subscription_discounts')->insert([
                'subscription_id' => $subscription->id,
                'promocode' => $promocode,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
    }

    protected function promoCodeToCouponId($promocode)
    {
        return data_get([
            'STARTERBLACKFRIDAY2021' => config('cashier.coupon_starter_id'),
            'STANDARDBLACKFRIDAY2021' => config('cashier.coupon_standard_id'),
            'UNLIMITEDBLACKFRIDAY2021' => config('cashier.coupon_unlimited_id'),
        ], $promocode ?? '', '');
    }

    protected function promoCodeToId($promocode)
    {
        return data_get([
            'STARTERBLACKFRIDAY2021' => config('cashier.promo_starter_id'),
            'STANDARDBLACKFRIDAY2021' => config('cashier.promo_standard_id'),
            'UNLIMITEDBLACKFRIDAY2021' => config('cashier.promo_unlimited_id'),
        ], $promocode ?? '', '');
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

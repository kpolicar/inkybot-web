<?php namespace App;


use App\Models\User;
use Illuminate\Support\Collection;
use Stripe\Price;

class Billing
{
    public static $starterPlanCode = 'starter';
    public static $standardPlanCode = 'standard';
    public static $unlimitedPlanCode = 'unlimited';
    public static $unlimitedWithQueuePlanCode = 'unlimited_with_queue';


    public static function resolvePlan($plan)
    {
        if ($plan == static::$starterPlanCode)
            return static::starterPlan();
        if ($plan == static::$standardPlanCode)
            return static::standardPlan();
        if ($plan == static::$unlimitedPlanCode)
            return static::unlimitedPlan();
        if ($plan == static::$unlimitedWithQueuePlanCode)
            return static::unlimitedWithQueuePlan();

        throw new \InvalidArgumentException();
    }

    public static function starterPlan() {
        return config('cashier.product_price_starter_id');
    }

    public static function standardPlan() {
        return config('cashier.product_price_standard_id');
    }

    public static function unlimitedPlan() {
        return config('cashier.product_price_unlimited_id');
    }

    public static function unlimitedWithQueuePlan() {
        return config('cashier.product_price_unlimited_with_queue_id');
    }

    public static function price($plan, $user, $quantity=1, $promocode='')
    {
        $price = Price::retrieve([
            'id' => Billing::resolvePlan($plan),
            'expand' => ['tiers']
        ], $user->stripeOptions());

        $amount = $price->billing_scheme == Price::BILLING_SCHEME_TIERED
            ? static::resolveAmountForTieredPrice($user, $price, $quantity)
            : $price->unit_amount;

        $amount += $user->stripe_balance;
        $amount = max(0, $amount);

        if ($plan == Billing::$starterPlanCode && $promocode == 'STARTERBLACKFRIDAY2021') {
            $amount -= static::priceDecreaseForPromoCode($promocode);
        } else if ($plan == Billing::$standardPlanCode && $promocode == 'STANDARDBLACKFRIDAY2021') {
            $amount -= static::priceDecreaseForPromoCode($promocode);
        } else if (($plan == Billing::$unlimitedPlanCode || $plan == Billing::$unlimitedWithQueuePlanCode) && $promocode == 'UNLIMITEDBLACKFRIDAY2021') {
            $amount -= static::priceDecreaseForPromoCode($promocode);
        }

        return $amount;
    }

    public static function priceDecreaseForPromoCode($promocode)
    {
        return data_get([
            'STARTERBLACKFRIDAY2021' => 80,
            'STANDARDBLACKFRIDAY2021' => 150,
            'UNLIMITEDBLACKFRIDAY2021' => 200,
        ], $promocode ?? '', 0);
    }

    private static function resolveAmountForTieredPrice(User $user, Price $price, $quantity)
    {
        $amount = 0;
        $count = optional($user->validSubscription())->quantity ?: 0;

        while ($quantity > 0) {
            $nextTier = collect($price->tiers)->sortBy(function ($tier) {
                if ($tier->up_to === null)
                    return PHP_INT_MAX;
                return $tier->up_to;
            })->first(function ($tier) use (&$currentTier, $count) {
                $upTo = $tier->up_to === null
                    ? PHP_INT_MAX
                    : $tier->up_to;
                return $upTo > $count;
            });
            $count++;
            $quantity--;
            $amount += $nextTier->unit_amount;
        }

        return $amount;
    }
}

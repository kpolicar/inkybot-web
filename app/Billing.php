<?php namespace App;


use App\Models\User;
use Illuminate\Support\Collection;
use Stripe\Price;

class Billing
{
    public static $starterPlanCode = 'starter';
    public static $standardPlanCode = 'standard';
    public static $unlimitedPlanCode = 'unlimited';


    public static function resolvePlan($plan)
    {
        if ($plan == static::$starterPlanCode)
            return static::starterPlan();
        if ($plan == static::$standardPlanCode)
            return static::standardPlan();
        if ($plan == static::$unlimitedPlanCode)
            return static::unlimitedPlan();

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

    public static function price($plan, $user, $quantity=1)
    {
        $price = Price::retrieve([
            'id' => Billing::resolvePlan($plan),
            'expand' => ['tiers']
        ], $user->stripeOptions());

        $amount = $price->billing_scheme == Price::BILLING_SCHEME_TIERED
            ? static::resolveAmountForTieredPrice($user, $price, $quantity)
            : $price->unit_amount;

        return $amount;
    }

    private static function resolveAmountForTieredPrice(User $user, Price $price, $quantity)
    {
        $amount = 0;
        $count = optional($user->subscription())->quantity ?: 0;

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

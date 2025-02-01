<?php

namespace App\Models;

use Cache;
use App\Billing;
use App\Events\UserLinkedWithDiscord;
use App\Models\Traits\UserCacheAttributes;
use App\Models\Traits\UserThrottles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Passport\HasApiTokens;
use Stripe\Invoice;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Billable, UserThrottles, UserCacheAttributes {
        subscription as cashierSubscription;
        subscribed as cashierSubscribedOriginal;
        subscribedToPlan as cashierSubscribedToPlan;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'stripe_id',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'card_brand',
        'card_last_four',
    ];

    protected $with = [
        'subscriptions'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscribed_to' => 'datetime',
    ];

    protected $appends = [
        'is_free_trial', 'free_trial_available',
    ];


    protected static function boot()
    {
        parent::boot();

        parent::creating(function (User $user) {
            $user->GenerateReferralCode();

            if ($referredBy = \Cookie::get('referral')) {
                $user->referred_by = static::FindByReferral($referredBy)->id;
            }
        });
    }

    public function numberOfExoMagesInPricingPlan()
    {
        if ($this->subscribedToPlan(Billing::unlimitedPlan()))
            return config('cashier.product_price_unlimited_exo_mages');
        else if ($this->subscribedToPlan(Billing::unlimitedWithQueuePlan()))
            return config('cashier.product_price_unlimited_with_queue_exo_mages');
        else if ($this->subscribedToPlan(Billing::standardPlan()))
            return config('cashier.product_price_standard_exo_mages');
        else if ($this->subscribedToPlan(Billing::starterPlan()))
            return config('cashier.product_price_starter_exo_mages');
        else
            return 0;
    }

    public function mageDatesNotFromToday()
    {
        return Cache::remember(
            'user-'.$this->id.'-magings',
            $this->freshTimestamp()->endOfDay(),
            function () {
                return $this->maging()->notTodays()->latest()->pluck('created_at');
            });
    }

    public function validSubscription()
    {
        return optional($this->subscription())->valid() ? $this->subscription() : null;
    }

    public function referrer() {
        return $this->belongsTo(User::class, 'referred_by', 'id');
    }

    public function free_trial() {
        return $this->hasOne(FreeTrial::class);
    }

    public function publishes() {
        return $this->hasMany(MagePublish::class);
    }

    public function maging() {
        return $this->hasMany(Maging::class);
    }

    protected function GenerateReferralCode() {
        do {
            $this->referral_code = $referralCode = \Str::random(10);
        } while (static::FindByReferral($referralCode)->exists);
    }

    public function GetIsFreeTrialAttribute() {
        if ($this->subscribed())
            return false;
        $trial = optional($this->free_trial);
        return $trial->exists && !$trial->expired;
    }

    public function GetFreeTrialAvailableAttribute() {
        $trial = optional($this->free_trial);
        return !$trial->exists || !$trial->expired;
    }

    public function GetTrialEndsAtAttribute()
    {
        return optional($this->free_trial)->expires_at;
    }

    public static function FindByReferral($code) {
        return optional(static::firstWhere('referral_code', $code));
    }

    public function numberOfExoMagesLeftInPlan()
    {
        $exoMagesInPlan = $this->numberOfExoMagesInPricingPlan();
        if (!$this->subscribed()
            || $this->subscribedToPlan(Billing::unlimitedPlan())
            || $this->subscribedToPlan(Billing::unlimitedWithQueuePlan()))
            return $exoMagesInPlan;

        $currentPeriodEnd = $this->subscription()->asDateTime(
            $this->subscription()->current_period_end
        );

        $magings = $this->maging()
            ->whereDate('updated_at', '>', $currentPeriodEnd->subMonth())
            ->get();

        $exoMagesSoFar = $magings
            ->pluck('exo_successes')
            ->mapInto(Collection::class)
            ->map->only(['ap', 'mp', 'range', 'summons'])
            ->map->sum()->sum();

        return max(0, $exoMagesInPlan-$exoMagesSoFar);
    }

    public function subscribedDeprecated()
    {
        return true; // todo temporary everyone subscribed
        //return !!optional($this->subscribed_to)->isAfter(now());
    }

    public function subscription($name = 'default')
    {
        $cashierSubscription = $this->cashierSubscription($name);
        if ($cashierSubscription) {
            return $cashierSubscription;
        }
        if ($this->subscribedDeprecated()) {

            $dummySubscription = $this->subscriptions()->make([
                'name' => $name,
                'stripe_status' => 'cancelled',
                'stripe_plan' => Billing::unlimitedWithQueuePlan(),
                'quantity' => 1,
                'current_period_end' => $this->subscribed_to,
                'ends_at' => $this->subscribed_to,
            ]);

            return $dummySubscription;
        }

        return $cashierSubscription;
    }

    public function subscribed($name = 'default', $plan = null)
    {
        if ($this->subscribedDeprecated())
            return true;

        return $this->cashierSubscribedOriginal($name, $plan);
    }

    public function subscribedToPlan($plans, $name = 'default')
    {
        if ($plans == Billing::unlimitedWithQueuePlan() && $this->subscribedDeprecated())
            return true;

        return $this->cashierSubscribedToPlan($plans, $name);
    }

    public function cashierSubscribed($name = 'default', $plan = null)
    {
        $subscription = $this->cashierSubscription($name);

        if (! $subscription || ! $subscription->valid()) {
            return false;
        }

        return $plan ? $subscription->hasPlan($plan) : true;
    }

    public function linkDiscord($id)
    {
        $success = $this->forceFill([
            'discord_id' => $id
        ])->save();
        if ($success)
            UserLinkedWithDiscord::dispatch($this);
    }

    public function incompletePaymentHostedUrl()
    {
        return Invoice::retrieve(
            $this->subscription()->asStripeSubscription()->latest_invoice,
            $this->stripeOptions()
        )->hosted_invoice_url;
    }
}

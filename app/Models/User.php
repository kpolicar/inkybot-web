<?php

namespace App\Models;

use App\Models\Traits\UserThrottles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Billable, UserThrottles;

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

    protected $hasUpdatedSubscribedToFromCashier = false;

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

    public static function FindByReferral($code) {
        return optional(static::firstWhere('referral_code', $code));
    }

    public function linkDiscord($id)
    {
        $this->forceFill([
            'discord_id' => $id
        ])->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referred_by',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        'is_subscribed'
    ];

    protected static function boot()
    {
        parent::boot();
        parent::creating(function ($user) {
            $user->referral_code = \Str::random(20);
        });
    }

    public function GetIsSubscribedAttribute() {
        //return false;
        return $this->freshTimestamp()->isBefore($this->subscribed_to);
    }

    public function ExtendedSubscriptionDate() {
        $extendedDate = $this->subscribed_to ?? $this->freshTimestamp();
        $extendedDate = $extendedDate->maximum($this->freshTimestamp());
        return $extendedDate->addMonth();
    }

    public static function FindByReferral($code) {
        return optional(static::firstWhere('referral_code', $code));
    }
}

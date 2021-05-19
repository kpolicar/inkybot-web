<?php

namespace App\Providers;

use App\Billing;
use App\Http\Middleware\DecryptApiRequest;
use App\Http\Middleware\EncryptApiResponse;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPassport();
        $this->registerGates();
    }

    protected function registerPassport()
    {
        Passport::routes(null, [
            'prefix' => 'oauth-v2',
            'middleware' => [DecryptApiRequest::class, EncryptApiResponse::class]
        ]);
        Passport::routes(null, [
            'prefix' => 'oauth',
            'middleware' => [DecryptApiRequest::class, EncryptApiResponse::class]
        ]);

        Passport::tokensExpireIn(now()->addMinutes(5));
        Passport::refreshTokensExpireIn(now()->addMinutes(5));

        Token::creating(function (Token $token) {
            if (!$token->name) {
                $token->name = request()->post('_passport_token_name');
            }
        });
    }

    protected function registerGates()
    {
        Gate::define('purchase-subscription', function (User $user) {
            if ($user->subscribedDeprecated())
                return false;
            return $user->hasVerifiedEmail()
                && (!$user->hasStripeId() || !$user->subscribed())
                && !$user->hasIncompletePayment();
        });

        Gate::define('view-statistics', function (User $user) {
            return $user->subscribed()
                && ($user->subscribedToPlan(Billing::standardPlan()) || $user->subscribedToPlan(Billing::unlimitedPlan()));
        });

        Gate::define('view-exos', function (User $user) {
            return $user->subscribed()
                && ($user->subscribedToPlan(Billing::standardPlan()) || $user->subscribedToPlan(Billing::unlimitedPlan()));
        });

        Gate::define('mage-exos', function (User $user) {
            return $user->subscribed();
        });

        Gate::define('custom-maging-ai', function (User $user) {
            return $user->subscribed()
                && ($user->subscribedToPlan(Billing::standardPlan()) || $user->subscribedToPlan(Billing::unlimitedPlan()));
        });
    }
}

<?php

namespace App\Providers;

use App\Billing;
use App\Http\Middleware\DecryptApiRequest;
use App\Http\Middleware\EncryptApiResponse;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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
        Passport::routes(null, [
            'prefix' => 'oauth-v2',
            'middleware' => [DecryptApiRequest::class, EncryptApiResponse::class]
        ]);

        Passport::tokensExpireIn(now()->addMinutes(2));
        Passport::refreshTokensExpireIn(now()->addMinutes(5));

        Gate::define('purchase-subscription', function (User $user) {
            return $user->hasVerifiedEmail() && (!$user->hasStripeId() || !$user->subscribed());
        });

        Gate::define('view-statistics', function (User $user) {
            return $user->subscribed() && !$user->subscribedToPlan(Billing::starterPlan());
        });
    }
}

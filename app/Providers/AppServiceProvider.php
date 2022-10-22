<?php

namespace App\Providers;

use App\Billing;
use App\Contracts\ApiEncrypter as ApiEncrypterContract;
use App\RefreshTokenRepository;
use App\TokenRepository;
use Carbon\Carbon;
use CoinbaseCommerce\ApiClient as CoinbaseClient;
use Illuminate\Encryption\Encrypter;
use Laravel\Cashier\Subscription;
use Laravel\Passport\RefreshTokenRepository as PassportRefreshTokenRepository;
use Laravel\Passport\TokenRepository as PassportTokenRepository;
use Str;
use App\ClientVersion;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPassport();
        $this->registerCrypt();
        $this->app->instance(ClientVersion::class, new ClientVersion);
        if ($key=config('services.coinbase.key'))
            CoinbaseClient::init($key);
    }

    private function registerPassport()
    {
        $this->app->singleton(PassportRefreshTokenRepository::class, function () {
            return new RefreshTokenRepository();
        });
        $this->app->singleton(PassportTokenRepository::class, function () {
            return new TokenRepository();
        });
    }

    private function registerCrypt()
    {
        $this->app->bind(ApiEncrypterContract::class, function () {
            $key = config('app.api_key');
            if (Str::startsWith($key, 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }
            return new Encrypter($key, config('app.cipher'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount, 2) . ' €'; ?>";
        });

        Blade::if('subscribed', function () {
            return optional(auth()->user())->subscribed() ?? false;
        });
        Blade::if('verified', function () {
            return optional(auth()->user())->hasVerifiedEmail() ?? false;
        });
        Blade::if('unverified', function () {
            return !(optional(auth()->user())->hasVerifiedEmail() ?? false);
        });
        Subscription::saved(function ($model) {
            optional($model->user)->userCacheAttributesNumberOfExoMagesLeftInPlanClearCache();
        });

        $this->app->singleton('cryptoPromo', function () {
            return now()->isBefore('2022-11-01');
        });

        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        \URL::forceRootUrl(\Config::get('app.url'));
        \View::share('download_password', "inkybot");
        \View::share('cryptoPromo', $this->app['cryptoPromo']);
    }
}

<?php

namespace App\Providers;

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
        $this->app->singleton(ClientVersion::class, function () {
            return new ClientVersion();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('subscribed', function () {
            return optional(auth()->user())->is_subscribed;
        });

        if (config('app.env') == 'production') {
            \URL::forceScheme('https');
        }
    }
}

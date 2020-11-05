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
        $this->app->instance(ClientVersion::class, new ClientVersion);
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

        $currentVersion = $this->app[ClientVersion::class]->latest();
        \View::share('download_asset', "storage/Inkybot_0{$currentVersion['number']}beta.zip");
    }
}

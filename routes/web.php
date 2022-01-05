<?php

use App\ClientVersion;
use App\Exports\MagingExport;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CoinbaseController;
use App\Http\Controllers\CoinbaseWebhookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LinkDiscordController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Middleware\NotSubscribed;
use App\Http\Middleware\PlanExists;
use App\Http\Middleware\SetLocaleFromSession;
use App\Http\Middleware\Subscribed;
use App\Http\Middleware\RedirectToInvoicePageIfIncompletePayment;
use App\Models\Maging;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::get('/', [Controller::class, 'home'])
        ->name('home');

    Route::middleware('auth')
        ->get(LaravelLocalization::transRoute('routes.download'), [Controller::class, 'download'])
        ->name('download');

    Route::get(LaravelLocalization::transRoute('routes.profile'), [Controller::class, 'profile'])
        ->middleware('auth')
        ->name('profile');

        Route::middleware(['auth', 'verified', RedirectToInvoicePageIfIncompletePayment::class, PlanExists::class])
            ->group(function () {

                Route::get(LaravelLocalization::transRoute('routes.subscribe'), [Controller::class, 'subscribe'])
                    ->name('subscribe');

                Route::get(LaravelLocalization::transRoute('routes.subscribe-manage'), [Controller::class, 'subscriptionManage'])
                    ->middleware('throttle:3,1')
                    ->name('subscribe-manage');


                Route::middleware('can:purchase-subscription')->group(function () {

                    Route::view(LaravelLocalization::transRoute('routes.subscribe-stripe'), 'subscribe-stripe')
                        ->name('subscribe.stripe');

                    Route::view(LaravelLocalization::transRoute('routes.subscribe-coinbase'), 'subscribe-coinbase')
                        ->name('subscribe.coinbase');

                    Route::post(LaravelLocalization::transRoute('routes.subscribe-coinbase-checkout'), [CoinbaseController::class, 'subscribe'])
                        ->middleware('throttle:2,1')
                        ->name('subscribe.coinbase.checkout');

                    Route::post('/pay/subscribe/{paymentId}', [StripeController::class, 'subscribe'])
                        ->name('pay');

                });

            });

        Route::view(LaravelLocalization::transRoute('routes.install'), 'install')
            ->name('install');

    Route::prefix('/release/{version?}')->group(function () {

        Route::get('/', [Controller::class, 'releaseNotes'])
            ->name('release');

        Route::get('/usage', [Controller::class, 'usage'])
            ->name('release.usage');
    });

    Route::view('terms', 'terms')
        ->name('terms');

    Route::get(LaravelLocalization::transRoute('routes.export'), [Controller::class, 'export'])
        ->name('export')
        ->middleware(['auth', Subscribed::class, 'throttle:1,10,export']);

    require 'fortify.php';

    Route::view(LaravelLocalization::transRoute('routes.login-discord'), 'discord-link')
        ->middleware(['guest'])
        ->name('login.discord');

    Route::get(LaravelLocalization::transRoute('routes.statistics_activity'), [Controller::class, 'activity'])
        ->middleware('auth')
        ->name('statistics.activity');
});

Route::prefix('discord')->group(function () {
    Route::redirect('/', 'https://discord.gg/Fkg37XTtq2')->name('discord');

    Route::get('link/{id}', [LinkDiscordController::class, '__invoke'])
        ->middleware([SetLocaleFromSession::class, 'auth', 'signed', 'throttle:3,1'])
        ->name('discord.link');
});


Route::get('price', [BillingController::class, 'price'])
    ->name('billing.price');
Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('coinbase/webhook', [CoinbaseWebhookController::class, 'handleWebhook']);

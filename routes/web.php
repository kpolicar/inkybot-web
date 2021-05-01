<?php

use App\ClientVersion;
use App\Exports\MagingExport;
use App\Http\Controllers\CoinbaseController;
use App\Http\Controllers\CoinbaseWebhookController;
use App\Http\Controllers\LinkDiscordController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Middleware\SetLocaleFromSession;
use App\Http\Middleware\Subscribed;
use App\Models\Maging;
use Illuminate\Http\Request;
use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;
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

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get(LaravelLocalization::transRoute('routes.profile'), function (Request $request) {
        $message = $request->getSession()->get('notification');
        $action = "";
        if (!$message) {
            if (!optional($request->user())->hasVerifiedEmail()) {
                $message = __('forms.quick_verify_header');
                $action = 'partials.resend-verification';
            } elseif ($request->get('verified')) {
                $message = __('forms.quick_verify_success');
            }
        }

        return view('profile')
            ->with(compact('message', 'action'));
    })->middleware('auth')->name('profile');

    Route::post('/pay/subscribe/{paymentId}', [StripeController::class, 'subscribe'])
        ->middleware(['auth', 'verified'])
        ->name('pay');

        Route::view(LaravelLocalization::transRoute('routes.subscribe'), 'subscribe')
            ->name('subscribe')
            ->middleware('verified');

        Route::view(LaravelLocalization::transRoute('routes.subscribe-stripe'), 'subscribe-stripe')
            ->name('subscribe.stripe')
            ->middleware('verified');

        Route::view(LaravelLocalization::transRoute('routes.subscribe-coinbase'), 'subscribe-coinbase')
            ->name('subscribe.coinbase')
            ->middleware('verified');

        Route::post(LaravelLocalization::transRoute('routes.subscribe-coinbase-checkout'), [CoinbaseController::class, 'subscribe'])
            ->name('subscribe.coinbase.checkout')
            ->middleware('verified');

        Route::get(LaravelLocalization::transRoute('routes.install'), function (Request $request) {
            return view('install');
        })->name('install');

    Route::get('/release/{version?}', function (ClientVersion $versions, $version) {
        $versionDetails = $version == "latest" ?
            $versions->latest() :
            $versions->firstWhere('code', $version);
        $view = $versionDetails['number'] ?? abort(404);

        return view("release.$view", ['version' => $versionDetails]);
    })->name('release');

    Route::get(LaravelLocalization::transRoute('routes.export'), function (Request $request) {
        return new MagingExport($request->user());
    })->name('export')->middleware(['auth', Subscribed::class, 'throttle:1,10,export']);

    require_once 'fortify.php';

    Route::view(LaravelLocalization::transRoute('routes.login-discord'), 'discord-link')
        ->middleware(['guest'])
        ->name('login.discord');
});

Route::prefix('discord')->group(function () {
    Route::get('link/{id}', [LinkDiscordController::class, '__invoke'])
        ->middleware([SetLocaleFromSession::class, 'auth', 'signed', 'throttle:3,1'])
        ->name('discord.link');
});

Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('coinbase/webhook', [CoinbaseWebhookController::class, 'handleWebhook']);

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

    Route::get('/', function () {
        $gameVersion = Cache::get('game_version', function () {
            $response = rescue(function () {
               return Http::get('https://launcher.cdn.ankama.com/cytrus.json')->json();
            }, []);

            $gameVersion = Str::after(
                data_get($response, 'games.dofus.platforms.windows.main', config('app.latest_dofus_version')),
                '_');

            Cache::put('game_version', $gameVersion, now()->addDay());
            return $gameVersion;
        });

        return view('welcome', compact('gameVersion'));
    })->name('home');

    Route::middleware('auth')
        ->get(LaravelLocalization::transRoute('routes.download'), function (ClientVersion $version) {
            $currentVersion = $version->latest();
            return redirect(asset("storage/Inkybot_{$currentVersion['code']}patch1.zip"));
    })->name('download');

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
        $request->user()->loadMissing(['publishes' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        return view('profile')
            ->with(compact('message', 'action'));
    })->middleware('auth')->name('profile');

        Route::middleware(['auth', 'verified', RedirectToInvoicePageIfIncompletePayment::class, PlanExists::class])
            ->group(function () {

                Route::get(LaravelLocalization::transRoute('routes.subscribe'), function (Request $request) {
                    if (!$request->user()->can('purchase-subscription')) {
                        return redirect(route('subscribe-manage'));
                    } else {
                        return view('subscribe');
                    }
                })->name('subscribe');

                Route::get(LaravelLocalization::transRoute('routes.subscribe-manage'), function (Request $request) {
                    if (!$request->user()->cashierSubscribed())
                        abort(403);
                    return $request->user()->redirectToBillingPortal(url()->previous());
                })->middleware('throttle:3,1')->name('subscribe-manage');


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

        Route::get(LaravelLocalization::transRoute('routes.install'), function (Request $request) {
            return view('install');
        })->name('install');

    Route::prefix('/release/{version?}')->group(function () {

        Route::get('/', function (ClientVersion $versions, $version){
            $versionDetails = $version == "latest" ?
                $versions->latest() :
                $versions->firstWhere('code', $version);
            $view = $versionDetails['number'] ?? abort(404);
            return view("release.$view", ['version' => $versionDetails]);
        })->name('release');

        Route::get('/usage', function (...$args) {
            return redirect()->to(route('release', $args).'#usage', 307);
        })->name('release.usage');

    });

    Route::view('terms', 'terms')
        ->name('terms');

    Route::get(LaravelLocalization::transRoute('routes.export'), function (Request $request) {
        return new MagingExport($request->user());
    })->name('export')->middleware(['auth', Subscribed::class, 'throttle:1,10,export']);

    require_once 'fortify.php';

    Route::view(LaravelLocalization::transRoute('routes.login-discord'), 'discord-link')
        ->middleware(['guest'])
        ->name('login.discord');

    Route::get(LaravelLocalization::transRoute('routes.statistics_activity'), [Controller::class, 'activity'])
        ->middleware('auth')
        ->name('statistics.activity');
});

Route::prefix('discord')->group(function () {
    Route::get('/', function () {
        return redirect()->to('https://discord.gg/Fkg37XTtq2');
    })->name('discord');

    Route::get('link/{id}', [LinkDiscordController::class, '__invoke'])
        ->middleware([SetLocaleFromSession::class, 'auth', 'signed', 'throttle:3,1'])
        ->name('discord.link');
});


Route::get('price', [BillingController::class, 'price'])
    ->name('billing.price');
Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('coinbase/webhook', [CoinbaseWebhookController::class, 'handleWebhook']);

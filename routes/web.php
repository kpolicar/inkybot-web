<?php

use App\ClientVersion;
use App\Exports\MagingExport;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
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
        $maging = Maging::todaysForUser($request->user());

        return view('profile')
            ->with(compact('message', 'action', 'maging'));
    })->middleware('auth')->name('profile');

    Route::post('/pay/subscribe/{paymentId}', [StripeController::class, 'subscribe'])
        ->middleware(['auth', 'verified'])
        ->name('pay');

        Route::get(LaravelLocalization::transRoute('routes.subscribe'), function (Request $request) {
            return view('subscribe');
        })->name('subscribe')->middleware('verified');

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
});

Route::post(
    'stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

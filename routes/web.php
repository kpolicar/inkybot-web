<?php

use App\ClientVersion;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/profile', function (Request $request) {
    $message = $action = "";
    if (!optional($request->user())->hasVerifiedEmail()) {
        $message = "Please verify your email address to complete registration.";
        $action = 'partials.resend-verification';
    } elseif ($request->get('verified')) {
        $message = "You have successfully verified your email.";
    }

    return view('profile')
        ->with(compact('message', 'action'));
})->name('profile');

Route::post('/pay/subscribe/{paymentId}', [StripeController::class, 'subscribe'])
    ->middleware('verified');

Route::get('/subscribe', function (Request $request) {
    return view('subscribe');
})->name('subscribe')->middleware('verified');

Route::get('/install', function (Request $request) {
    return view('install');
})->name('install');

Route::post(
    'stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::get('/release/{version?}', function (ClientVersion $versions, $version) {
    $versionDetails = $version == "latest" ?
        $versions->latest() :
        $versions->firstWhere('code', $version);
    $view = $versionDetails['number'] ?? abort(404);

    return view("release.$view");
})->name('release');


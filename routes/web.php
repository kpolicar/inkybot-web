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
    $message = $request->getSession()->get('notification');
    $action = "";
    if (!$message) {
        if (!optional($request->user())->hasVerifiedEmail()) {
            $message = "Please verify your email address to complete registration.";
            $action = 'partials.resend-verification';
        } elseif ($request->get('verified')) {
            $message = "You have successfully verified your email.";
        }
    }

    return view('profile')
        ->with(compact('message', 'action'));
})->middleware('auth')->name('profile');

Route::post('/pay/subscribe/{paymentId}', [StripeController::class, 'subscribe'])
    ->middleware(['auth', 'verified']);

Route::get('/subscribe', function (Request $request) {
    return view('subscribe');
})->name('subscribe')->middleware('verified');

Route::get('/install', function (Request $request) {
    return view('install');
})->name('install');

Route::get('/gifts/christmas', function (Request $request) {
    return view('christmas');
})->name('gifts.christmas');

Route::post('/gifts/christmas/claim', function (Request $request) {
    $request->validate([
        'confirmation' => 'accepted'
    ], [
        'confirmation.accepted' => 'Only good boys/girls can claim their gifts.',
    ]);

    $user = $request->user();
    if (!$user->has_claimed_christmas_gift) {
        $message = "You have successfully claimed your christmas gift! Happy holidays!";
        $user->has_claimed_christmas_gift = true;
        $user->subscribed_to = $user->subscribed_to->addDays(5);
        $user->save();
    } else {
        $message = "Naughty, naughty! You have already claimed your christmas gift!";
    }

    return redirect()
        ->route('profile')
        ->with(['notification' => $message]);
})->middleware('auth')->name('gifts.christmas');

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


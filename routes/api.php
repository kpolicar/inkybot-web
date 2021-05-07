<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ClientStatisticsController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\NotificationController;
use App\Http\Resources\ClientFreeTrial as ClientFreeTrialResource;
use App\Models\FreeTrial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/discord')->group(function () {
    Route::post('login', [DiscordController::class, "Login"]);

    Route::post('link-generate', [DiscordController::class, 'Url'])
        ->name('discord.send');
});


Route::get('/', [ApiController::class, 'Info']);

Route::middleware('auth:api')->post('/trial/begin', function (Request $request) {
    $freeTrial = FreeTrial::where('user_id', $user_id = $request->user()->id)
        ->orWhere('ip_address', $ip_address = $request->ip())
        ->updateOrCreate([], compact('user_id', 'ip_address'));

    return new ClientFreeTrialResource($freeTrial);
});

Route::middleware(['auth:api', 'throttle:notification_rate_limit_per_minute,1,notification'])
    ->prefix('/notify')
    ->group(function () {
        Route::post('error', [ApiController::class, "NotifyError"]);
        Route::post('runes', [ApiController::class, "NotifyRunes"]);
        Route::post('finished', [ApiController::class, "NotifyFinished"]);
});

Route::middleware('auth:api')
    ->get('/user', [ApiController::class, 'User']);

Route::middleware('auth:api')
    ->get('/statistics', [ApiController::class, 'StatisticsView'])
    ->name('statistics.view');

Route::middleware('auth:api')
    ->post('/statistics/newsession', [ApiController::class, 'StatisticsNewSession'])
    ->name('statistics.newsession');

Route::middleware('auth:api')
    ->post('/statistics', [ApiController::class, "StatisticsUpdate"]);

Route::middleware(['auth:api', 'throttle:publish_rate_limit_per_hour,60,publish'])
    ->post('/publish', [ApiController::class, "StatisticsPublish"]);

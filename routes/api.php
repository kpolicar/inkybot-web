<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DiscordController;
use App\Http\Middleware\EncryptApiResponse;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectFromPublicUriMiddleware;
use App\Http\Middleware\Subscribed;
use App\Models\FreeTrial;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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

Route::middleware('auth:api')->group(function () {

    Route::post('/trial/begin', [ApiController::class, 'BeginTrial']);

    Route::middleware('throttle:notification_rate_limit_per_minute,1,notification')
        ->prefix('/notify')
        ->group(function () {
            Route::post('error', [ApiController::class, "NotifyError"]);
            Route::post('runes', [ApiController::class, "NotifyRunes"]);
            Route::post('actionneeded', [ApiController::class, "NotifyFinished"]);
            Route::post('finished', [ApiController::class, "NotifyFinished"]);
        });

    Route::get('/user', [ApiController::class, 'User']);

    Route::middleware(['can:view-statistics', 'throttle:view_statistics_rate_limit_per_minute,1,statistics_view'])
        ->get('/statistics', [ApiController::class, 'StatisticsView'])
        ->name('statistics.view');

    Route::middleware(['can:create-statistics', 'throttle:create_statistics_rate_limit_per_minute,1,statistics_new_session'])
        ->post('/statistics/newsession', [ApiController::class, 'StatisticsNewSession'])
        ->name('statistics.newsession');

    Route::middleware(['can:create-statistics', 'throttle:create_statistics_rate_limit_per_minute,1,statistics_create'])
        ->post('/statistics', [ApiController::class, "StatisticsUpdate"]);

    Route::middleware(['can:publish-exos', 'throttle:publish_rate_limit_per_hour,60,publish'])
        ->post('/publish', [ApiController::class, "StatisticsPublish"]);

});


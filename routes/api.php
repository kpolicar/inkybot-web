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
});


Route::middleware('auth:api')->post('/trial/begin', function (Request $request) {
    $freeTrial = FreeTrial::where('user_id', $user_id = $request->user()->id)
        ->orWhere('ip_address', $ip_address = $request->ip())
        ->updateOrCreate([], compact('user_id', 'ip_address'));

    return new ClientFreeTrialResource($freeTrial);
});

Route::middleware(['auth:api', 'throttle:3,1,notification'])->prefix('/notify')->group(function () {
    Route::post('error', [NotificationController::class, "Error"]);
    Route::post('runes', [NotificationController::class, "Runes"]);
    Route::post('finished', [NotificationController::class, "Finished"]);
});

Route::get('/', [ApiController::class, 'Info']);
Route::middleware('auth:api')->get('/user', [ApiController::class, 'User']);

Route::middleware('auth:api')->post('/statistics', [ClientStatisticsController::class, "Update"]);
Route::middleware(['auth:api', 'throttle:2,1,publish'])->post('/publish', [ClientStatisticsController::class, "Publish"]);

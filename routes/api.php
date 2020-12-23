<?php

use App\ClientVersion;
use App\Http\Controllers\ClientStatisticsController;
use App\Http\Controllers\NotificationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/trial/begin', function (Request $request) {
    return FreeTrial::where('user_id', $user_id = $request->user()->id)
        ->orWhere('ip_address', $ip_address = $request->ip())
        ->updateOrCreate([], compact('user_id', 'ip_address'));
});

Route::middleware('auth:api')->prefix('/notify')->group(function () {
    Route::post('error', [NotificationController::class, "Error"]);
    Route::post('runes', [NotificationController::class, "Runes"]);
    Route::post('finished', [NotificationController::class, "Finished"]);
});

Route::get('/', function (ClientVersion $versions) {
    $last = $versions->latest();

    return [
        'name' => $last['name'],
        'endpoint' => $last['code'],
        'number' => $last['number'],
    ];
});

Route::middleware('auth:api')->post('/statistics', [ClientStatisticsController::class, "Update"]);

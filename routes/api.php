<?php

use App\ClientVersion;
use App\Http\Controllers\NotificationController;
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

Route::prefix('/notify')->group(function () {
    Route::post('/', function (Request $request) {
        \OneSignal::sendNotificationToExternalUser(
            "This is a test notification.",
            \App\Models\User::where('email', 'naltamer14@gmail.com')->first()->id,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    });
    Route::post('error', [NotificationController::class, "Error"])->middleware('auth:api');
    Route::post('finished', [NotificationController::class, "Finished"])->middleware('auth:api');
});

Route::get('/', function (ClientVersion $versions) {
    $last = $versions->latest();

    return [
        'name' => $last['name'],
        'endpoint' => $last['code'],
        'number' => $last['number'],
    ];
});

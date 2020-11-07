<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function Error(Request $request) {
        \OneSignal::sendNotificationToExternalUser(
            "An error has occurred during maging. The bot has stopped.",
            $request->user()->id,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
        );
    }

    public function Finish(Request $request) {
        \OneSignal::sendNotificationToExternalUser(
            "The bot has finished maging.",
            $request->user()->id,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
        );
    }
}

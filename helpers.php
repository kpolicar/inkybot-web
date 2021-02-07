<?php

use Carbon\Carbon;

if (! function_exists('price')) {
    function price()
    {
        $lastAvailableDateToBuySubCheaper = Carbon::parse('2021-03-01 00:00:00');
        $user = request()->user();
        if (($user &&
            $user->subscribed_to->isAfter($lastAvailableDateToBuySubCheaper)) ||
            now()->isAfter($lastAvailableDateToBuySubCheaper)) {
            return 800;
        }
        return config('app.price');
    }
}

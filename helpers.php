<?php

use Carbon\Carbon;

if (! function_exists('price')) {
    function price()
    {
        $user = request()->user();
        if ($user && Carbon::parse('2021-03-01 00:00:00')->isBefore($user->subscribed_to)) {
            return 800;
        }
        return config('app.price');
    }
}

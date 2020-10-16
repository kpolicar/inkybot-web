<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function subscribe(Request $request, $paymentId) {
        $user = $request->user();
        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();

        $payment = $user->charge(500, $paymentId);
        $payment->validate();

        $extendedDate = $user->subscribed_to ?? $user->freshTimestamp();
        $extendedDate = $extendedDate->maximum($user->freshTimestamp());
        $extendedDate = $extendedDate->addMonth();

        $user->forceFill(['subscribed_to' => $extendedDate])
            ->save();
    }
}

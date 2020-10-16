<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Exception\CardException;

class StripeController extends Controller
{
    public function subscribe(Request $request, $paymentId) {
        $user = $request->user();
        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();

        try {
            $user->charge(500, $paymentId);
        } catch (IncompletePayment $exception) {
            return response()->view('partials.payment.payment-error', compact('exception'));
        } catch (CardException $exception) {
            return response()->view('partials.payment.card-error', compact('exception'));
        }

        return response()->view('partials.payment.success');
    }
}

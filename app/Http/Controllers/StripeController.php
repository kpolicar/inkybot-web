<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

class StripeController extends Controller
{
    public function subscribe(Request $request, $paymentId) {
        $user = $request->user();
        if (!$user->hasStripeId())
            $user->createAsStripeCustomer();

        try {
            $user->charge(500, $paymentId);
        } catch (IncompletePayment $exception) {
            return [
                "redirect" => route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('profile')],
                )
            ];
        } catch (CardException $exception) {
            return response()->view('partials.payment.card-error', compact('exception'));
        }

        return response()->view('partials.payment.success');
    }
}

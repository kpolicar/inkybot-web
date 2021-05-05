<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Models\User;
use Stripe\Price;
use Validator;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Exceptions\CoinbaseException;
use CoinbaseCommerce\Resources\Charge;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function price(Request $request)
    {
        $currency = $request->user()->preferredCurrency();
        $amount = Billing::price(
            $request->input('plan'),
            $request->user(),
            $request->post('quantity', 1));

        return compact('amount', 'currency');
    }
}

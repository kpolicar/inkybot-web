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
            $this->plan($request),
            $request->user(),
            $this->quantityFromPost($request),
            $request->post('promocode'));

        return compact('amount', 'currency');
    }

    public function checkPromoCode(Request $request)
    {
        return in_array($request->post('promocode'), [
            'STARTERBLACKFRIDAY2021',
            'STANDARDBLACKFRIDAY2021',
            'UNLIMITEDBLACKFRIDAY2021',
        ]);
    }

    protected function plan(Request $request)
    {
        return $request->boolean('queue') && $request->input('plan') == Billing::$unlimitedPlanCode
            ? Billing::$unlimitedWithQueuePlanCode
            : $request->input('plan');
    }

    protected function quantityFromPost(Request $request)
    {
        return in_array($request->post('plan'), [Billing::$unlimitedPlanCode, Billing::$unlimitedWithQueuePlanCode])
            ? min(10, max(1, $request->post('quantity', 1)))
            : 1;
    }

    protected function validateQuantity(Request $request)
    {
        $request->validate([
            'quantity' => 'nullable|numeric|between:1,10'
        ]);
    }
}

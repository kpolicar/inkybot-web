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

class CoinbaseController extends BillingController
{
    public function subscribe(Request $request)
    {
        $plan = $request->input('plan');
        $price = $this->price($request);
        $quantity = $request->post('quantity', 1);

        $description = __('pricing.package_'.$plan)." plan";
        if ($request->post('quantity', 1) > 1)
            $description .= ' * '.$quantity;

        $charge = new Charge(
            [
                "name" => '1 month subscription on Inkybot',
                "description" => $description,
                "metadata" => [
                    "user_id" => $request->user()->id,
                    "user_email" => $request->user()->email,
                    "quantity" => $quantity,
                    "plan" => $plan,
                ],
                "pricing_type" => "fixed_price",
                "local_price" => [
                    "amount" => number_format($price['amount']/100, 2),
                    "currency" => $price['currency'],
                ],
                'cancel_url' => route('subscribe.coinbase')
            ]
        );
        $charge->save();


        $validator = Validator::make($charge->getAttributes(), [
            'hosted_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        return redirect($charge['hosted_url']);
    }
}

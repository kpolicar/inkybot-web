<?php

namespace App\Http\Controllers;

use Validator;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Exceptions\CoinbaseException;
use CoinbaseCommerce\Resources\Charge;
use Illuminate\Http\Request;

class CoinbaseController extends Controller
{
    public function subscribe(Request $request)
    {
        $charge = new Charge(
            [
                "name" => config('app.name'),
                "description" => "1 month subscription on Inkybot",
                "metadata" => [
                    "user_id" => $request->user()->id,
                    "user_email" => $request->user()->email
                ],
                "pricing_type" => "fixed_price",
                "local_price" => [
                    "amount" => number_format(config('app.price')/100, 2),
                    "currency" => "EUR"
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

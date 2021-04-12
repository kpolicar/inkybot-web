<?php

namespace App\Http\Controllers;

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
        throw_unless($charge->getAttribute('hosted_url'), CoinbaseException::class);

        return redirect($charge->getAttribute('hosted_url'));
    }
}

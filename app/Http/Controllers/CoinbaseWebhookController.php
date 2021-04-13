<?php

namespace App\Http\Controllers;

use App\Events\CoinbaseWebhookReceived;
use DB;
use App\Events\UserPurchasedSubscription;
use App\Models\User;
use App\Notifications\CoinbaseChargeCompleted;
use App\Notifications\CoinbaseChargeFailed;
use App\Notifications\CoinbaseChargePending;
use CoinbaseCommerce\Resources\Charge;
use CoinbaseCommerce\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Events\WebhookReceived;
use Symfony\Component\HttpFoundation\Response;

class CoinbaseWebhookController extends Controller
{

    public function handleWebhook(Request $request)
    {
        $signature = $request->header('X-CC-Webhook-Signature');
        $event = Webhook::buildEvent($request->getContent(), $signature, config('services.coinbase.webhook_secret'));

        CoinbaseWebhookReceived::dispatch($event);

        $method = 'handle'.Str::studly(str_replace(':', '_', $event['type']));

        if (method_exists($this, $method)) {
            $response = $this->{$method}($event['data']);
        }

        return $response ?? new Response;
    }

    public function handleChargePending(Charge $charge)
    {
        $user = User::findOrFail($charge['metadata']['user_id']);
        $user->notify(new CoinbaseChargePending($charge));
    }

    public function handleChargeFailed(Charge $charge)
    {
        $user = User::findOrFail($charge['metadata']['user_id']);

        $lastUpdate = collect($charge['timeline'])->last();
        if (data_get($lastUpdate, 'status') == 'UNRESOLVED')
            $user->notify(new CoinbaseChargeFailed($charge));

    }

    public function handleChargeConfirmed(Charge $charge)
    {
        $user = User::findOrFail($charge['metadata']['user_id']);

        $success = $user
            ->forceFill(['subscribed_to' => $user->ExtendedSubscriptionDate(1)])
            ->save();

        if ($success) {
            UserPurchasedSubscription::dispatch($user);
            $user->notify(new CoinbaseChargeCompleted($charge));
        }
    }
}

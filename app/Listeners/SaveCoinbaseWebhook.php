<?php

namespace App\Listeners;

use Carbon\Carbon;
use DB;
use App\Events\CoinbaseWebhookReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveCoinbaseWebhook
{
    /**
     * Handle the event.
     *
     * @param CoinbaseWebhookReceived $data
     * @return void
     */
    public function handle(CoinbaseWebhookReceived $data)
    {
        DB::table('coinbase_webhook_calls')
            ->insert([
                'type' => $data->event['type'],
                'payload' => $data->event['data'],
                'created_at' => Carbon::now(),
            ]);
    }
}

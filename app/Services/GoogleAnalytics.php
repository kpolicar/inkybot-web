<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleAnalytics
{
    /** @var string */
    private $measurementId;

    /** @var string */
    private $apiSecret;

    public function __construct()
    {
        $this->measurementId = config('services.google_analytics.measurement_id', '');
        $this->apiSecret = config('services.google_analytics.api_secret', '');
    }

    public function sendEvent(User $user, string $eventName, array $params = [])
    {
        if (empty($this->measurementId) || empty($this->apiSecret)) {
            return;
        }

        $clientId = $user->ga_client_id;
        if (empty($clientId)) {
            Log::debug("GA4: No client_id for user {$user->id}, skipping event {$eventName}");
            return;
        }

        $payload = [
            'client_id' => $clientId,
            'user_id' => (string) $user->id,
            'events' => [
                [
                    'name' => $eventName,
                    'params' => $params,
                ],
            ],
        ];

        try {
            $response = Http::post(
                'https://www.google-analytics.com/mp/collect?' . http_build_query([
                    'measurement_id' => $this->measurementId,
                    'api_secret' => $this->apiSecret,
                ]),
                $payload
            );

            if (!$response->successful()) {
                Log::warning("GA4: Failed to send event {$eventName} for user {$user->id}", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning("GA4: Exception sending event {$eventName} for user {$user->id}: {$e->getMessage()}");
        }
    }

    public function sendRegistrationEvent(User $user)
    {
        $this->sendEvent($user, 'sign_up', [
            'method' => 'email',
        ]);
    }

    public function sendPurchaseEvent(User $user)
    {
        $subscription = $user->subscription('default');
        if (!$subscription) {
            return;
        }

        $plan = $this->resolvePlanName($subscription->stripe_price);
        $quantity = $subscription->quantity ?? 1;

        $params = [
            'transaction_id' => $subscription->stripe_id,
            'currency' => config('cashier.currency', 'eur'),
            'items' => [
                [
                    'item_id' => $subscription->stripe_price,
                    'item_name' => $plan,
                    'quantity' => $quantity,
                ],
            ],
        ];

        $this->sendEvent($user, 'purchase', $params);
    }

    private function resolvePlanName($priceId)
    {
        $plans = [
            config('cashier.product_price_starter_id') => 'Starter',
            config('cashier.product_price_standard_id') => 'Standard',
            config('cashier.product_price_unlimited_id') => 'Unlimited',
            config('cashier.product_price_unlimited_with_queue_id') => 'Unlimited with Queue',
        ];

        return $plans[$priceId] ?? 'Unknown';
    }
}

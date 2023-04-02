<?php

namespace App\Providers;

use App\Events\CoinbaseWebhookReceived;
use App\Events\MagePublishUploaded;
use App\Events\PaymentSucceeded;
use App\Events\UserLinkedWithDiscord;
use App\Events\UserPurchasedSubscription;
use App\Events\UserSyncedWithDiscord;
use App\Listeners\EnforceUniqueUserAccessToken;
use App\Listeners\PostMagePublishToForum;
use App\Listeners\SaveCoinbaseWebhook;
use App\Listeners\SendLinkSuccessfulToDiscord;
use App\Listeners\SendMagePublishToDiscord;
use App\Listeners\SendUserSubscriptionStatusToDiscord;
use App\Listeners\StorePayment;
use App\Models\MagePublish;
use App\Models\User;
use App\Observers\MagePublishObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Subscription;
use Laravel\Passport\Events\AccessTokenCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccessTokenCreated::class => [
            EnforceUniqueUserAccessToken::class,
        ],
        UserPurchasedSubscription::class => [
            SendUserSubscriptionStatusToDiscord::class,
        ],
        UserLinkedWithDiscord::class => [
            SendUserSubscriptionStatusToDiscord::class,
            SendLinkSuccessfulToDiscord::class,
        ],
        UserSyncedWithDiscord::class => [
            SendUserSubscriptionStatusToDiscord::class,
        ],
        MagePublishUploaded::class => [
            PostMagePublishToForum::class,
            SendMagePublishToDiscord::class,
        ],
        CoinbaseWebhookReceived::class => [
            SaveCoinbaseWebhook::class
        ],
        PaymentSucceeded::class => [
            StorePayment::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        MagePublish::observe(MagePublishObserver::class);
    }
}

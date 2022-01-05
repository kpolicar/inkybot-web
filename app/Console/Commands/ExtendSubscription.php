<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Stripe\Subscription;

class ExtendSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:extend {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extend subscription for a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('user_id'));

        if ($subscription = $user->subscription()) {
            $stripeSubscription = $subscription->asStripeSubscription();

            $currentPeriodStart = Carbon::createFromTimestamp($stripeSubscription->current_period_end)->subMonth();
            $currentPeriodEnd = Carbon::createFromTimestamp($stripeSubscription->current_period_end);
            $cancelAt = $stripeSubscription->cancel_at
                ? Carbon::createFromTimestamp($stripeSubscription->cancel_at)
                : null;

            $newSubscription = $user->newSubscription('default', $subscription->stripe_plan)
                ->quantity($subscription->quantity)
                ->noProrate()
                ->withMetadata([
                    'previous_stripe_id' => $subscription->stripe_id
                ])
                ->create(null, [], [
                    'backdate_start_date' => $currentPeriodStart->addDay()->unix(),
                    'billing_cycle_anchor' => $currentPeriodEnd->addDay()->unix(),
                    'cancel_at' => $cancelAt ? $cancelAt->addDay()->unix() : null,
                ]);

            if ($newSubscription) {
                $subscription
                    ->noProrate()
                    ->cancelNow();
            }

        }
        return 0;
    }
}

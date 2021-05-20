<?php

namespace App\Console\Commands;

use App\Models\User;
use DB;
use Validator;
use App\Models\Maging;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Cashier\Subscription;

class CreateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:create {date?} {--save}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a daily activity report for all the users';

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
        $customDate = $this->argument('date');
        if ($customDate) {
            try {
                $date = new Carbon($customDate);
            } catch (\Exception $e) {
                $this->error('The date is not a valid date.');
                return 1;
            }
        }
        $date = $date ?? now();
        $dateString = $date->toDateString();

        $magings = Maging::todays()->get();
        $exoAttempts = $magings->pluck('exo_attempts')
            ->mapInto(Collection::class)
            ->map->only(['ap', 'mp', 'range', 'summons'])
            ->map->sum()
            ->sum();
        $exoSuccesses = $magings->pluck('exo_successes')
            ->mapInto(Collection::class)
            ->map->only(['ap', 'mp', 'range', 'summons'])
            ->map->sum()
            ->sum();

        $timeMaging = $magings->pluck('time_maging')->sum();
        $payments = DB::table('payments')->whereDate('created_at', $dateString)->get();
        $paymentCount = $payments->count();
        $subscriptions = Subscription::whereDate('created_at', $dateString)->count();
        $revenue = $payments->pluck('amount')->sum();
        $newUsers = User::whereDate('created_at', $dateString)->count();

        $timeMagingInMinutes = $timeMaging/60;
        $revenueInEuros = $revenue/100;
        $this->info(
            "Revenue: €$revenueInEuros, ".
            "Payments: $paymentCount, ".
            "Subscriptions: $subscriptions, ".
            "Time Maging: $timeMagingInMinutes minutes, ".
            "Attempts: $exoAttempts, ".
            "Successes: $exoSuccesses, ".
            "New users: $newUsers");

        if ($this->option('save')) {
            DB::table('reports')->insert([
                'revenue' => $revenue,
                'payments' => $paymentCount,
                'subscriptions' => $subscriptions,
                'time_maging' => $timeMaging,
                'exo_attempts' => $exoAttempts,
                'exo_successes' => $exoSuccesses,
                'new_users' => $newUsers,
                'updated_at' => now(),
                'created_at' => $dateString,
            ]);
        }

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use DB;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NotifyYesterdaysReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:notify {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify the default user of yesterday\'s activity';

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
        $date = $date ?? now()->subDay();
        $dateString = $date->toDateString();

        $report = DB::table('reports')->whereDate('created_at', $dateString)->first();
        if (!$report) {
            $this->error('There was no report generated on the '.$dateString);
            return 1;
        }
        $user = User::where('email', 'naltamer14@gmail.com')->firstOrFail();

        $revenueInEuros = (int)($report->revenue / 100);
        $timeMagingInHours = (int)($report->time_maging/(60*60));


        $message = '**Report for '.$date->toDateString().'**';
        $message .= "\n".
            "> Revenue: **€$revenueInEuros**, \n".
            "> Payments: **$report->payments**, \n".
            "> Subscriptions: **$report->subscriptions**, \n".
            "> Time Maging: **$timeMagingInHours hours**, \n".
            "> Attempts: **$report->exo_attempts**, \n".
            "> Successes: **$report->exo_successes**, \n".
            "> New users: **$report->new_users**";

        $content = "!notify {$user->discord_id} \":bell: $message\"";
        \Http::post(
            config('discord.webhook_url'),
            compact('content')
        );

        return 0;
    }
}

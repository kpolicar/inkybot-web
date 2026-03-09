<?php

namespace App\Console\Commands;

use App\Mail\InkybotRelaunchMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRelaunchCampaign extends Command
{
    protected $signature = 'campaign:relaunch
                            {--to= : Send only to this email address (test mode)}
                            {--chunk=50 : Number of users to process per chunk}
                            {--delay=3 : Seconds to wait between chunks}
                            {--dry-run : Preview recipients without sending}
                            {--resume=0 : Skip the first N users (resume after interruption)}';

    protected $description = 'Send the Inkybot relaunch announcement to all verified users';

    public function handle(): int
    {
        $testEmail = $this->option('to');
        $chunkSize = (int) $this->option('chunk');
        $delay     = (int) $this->option('delay');
        $dryRun    = (bool) $this->option('dry-run');
        $skip      = (int) $this->option('resume');

        // Test mode: send to a single address and stop
        if ($testEmail) {
            $user = User::where('email', $testEmail)->first()
                ?? new User(['name' => 'Test', 'email' => $testEmail]);

            $this->info("Test mode — sending to {$testEmail}...");
            Mail::to($testEmail, $user->name)->send(new InkybotRelaunchMail($user));
            $this->info('Done.');
            return self::SUCCESS;
        }

        $query = User::orderBy('id')
            ->skip($skip);

        $total = $query->count();

        if ($total === 0) {
            $this->info('No eligible recipients found.');
            return self::SUCCESS;
        }

        $this->info(sprintf(
            '%s %d recipients in chunks of %d (delay: %ds between chunks)%s',
            $dryRun ? '[DRY RUN] Would send to' : 'Sending to',
            $total,
            $chunkSize,
            $delay,
            $skip > 0 ? " — resuming after {$skip} skipped users" : ''
        ));

        $sent        = 0;
        $failed      = 0;
        $chunkNumber = 0;

        $query->chunk($chunkSize, function ($users) use (
            $dryRun, $delay, $chunkSize, $total, &$sent, &$failed, &$chunkNumber
        ) {
            $chunkNumber++;

            foreach ($users as $user) {
                if ($dryRun) {
                    $this->line("  [DRY RUN] Would send to: {$user->email} ({$user->name})");
                    $sent++;
                    continue;
                }

                try {
                    Mail::to($user->email, $user->name)->send(new InkybotRelaunchMail($user));
                    $sent++;
                } catch (\Throwable $e) {
                    $failed++;
                    $this->error("  Failed for {$user->email}: {$e->getMessage()}");
                }
            }

            $this->info(sprintf(
                '  Chunk %d done — %d/%d sent%s',
                $chunkNumber,
                $sent,
                $total,
                $failed > 0 ? ", {$failed} failed" : ''
            ));

            if ($delay > 0 && ! $dryRun) {
                sleep($delay);
            }
        });

        $this->newLine();
        $this->info("Campaign complete. Sent: {$sent} | Failed: {$failed}");

        return self::SUCCESS;
    }
}

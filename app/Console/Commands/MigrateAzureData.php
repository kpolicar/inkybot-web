<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class MigrateAzureData extends Command
{
    protected $signature = 'db:migrate-azure {--tables= : Comma-separated list of tables to migrate} {--truncate : Truncate target tables before importing}';
    protected $description = 'Migrate data from Azure SQL Server to local MySQL';

    public function handle()
    {
        $allTables = [
            'users',
            'password_resets',
            'subscriptions',
            'subscription_items',
            'free_trials',
            'magings',
            'mage_publishes',
            'payments',
            'reports',
            'coinbase_webhook_calls',
            'oauth_clients',
            'oauth_personal_access_clients',
            'oauth_access_tokens',
            'oauth_auth_codes',
            'oauth_refresh_tokens',
        ];

        if ($this->option('tables')) {
            $tables = explode(',', $this->option('tables'));
        } else {
            $tables = $allTables;
        }

        try {
            DB::connection('sqlsrv')->getPdo();
            $this->info('Connected to Azure SQL Server.');
        } catch (\Exception $e) {
            $this->error('Cannot connect to Azure: ' . $e->getMessage());
            return 1;
        }

        Schema::connection('mysql')->disableForeignKeyConstraints();

        foreach ($tables as $table) {
            $table = trim($table);

            $sourceCount = DB::connection('sqlsrv')->table($table)->count();
            $this->info("Migrating: {$table} ({$sourceCount} rows)");

            if ($sourceCount === 0) {
                $this->warn("  Skipped (empty).");
                continue;
            }

            if ($this->option('truncate')) {
                DB::connection('mysql')->table($table)->truncate();
            }

            $bar = $this->output->createProgressBar($sourceCount);
            $bar->start();

            $firstRow = DB::connection('sqlsrv')->table($table)->first();
            $columns = array_keys((array) $firstRow);
            $hasId = in_array('id', $columns);

            $query = DB::connection('sqlsrv')->table($table);
            $query->orderBy($hasId ? 'id' : $columns[0]);

            $query->chunk(500, function ($records) use ($table, $bar) {
                $data = $records->map(function ($item) {
                    $row = (array) $item;
                    unset($row['row_num']);
                    return $row;
                })->toArray();

                DB::connection('mysql')->table($table)->insert($data);
                $bar->advance(count($data));
            });

            $bar->finish();
            $this->newLine();

            $targetCount = DB::connection('mysql')->table($table)->count();
            $this->info("  Done: {$targetCount} rows in MySQL.");
        }

        Schema::connection('mysql')->enableForeignKeyConstraints();
        $this->newLine();
        $this->info('Migration complete!');

        return 0;
    }
}

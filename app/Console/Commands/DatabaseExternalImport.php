<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseExternalImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:external_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Importing ZipCodes | Modal | Make ". now());
        DB::unprepared(base_path(file_get_contents('database/external_db/zipcodes.sql')));
        Artisan::call('db:seed');
        return Command::SUCCESS;
    }
}

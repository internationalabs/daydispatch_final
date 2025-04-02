<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Support\Facades\Auth;


class AutoLogoutUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:auto-logout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically log out users who have been inactive for 12 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // $user = Auth::guard('Authorized')->user();
        // dd($user->id);
        // 


        // $timeThreshold = Carbon::now()->subHours(12);
        $timeThreshold = Carbon::now()->subHours(12);


        $updatedCount = AuthorizedUsers::where('is_login', '>', 0)
            ->where('last_login', '<', $timeThreshold)
            ->update(['is_login' => 0]);

        // Auth::guard('Authorized')->logout();
        
        $this->info("Updated {$updatedCount} users.");



        return Command::SUCCESS;
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('expire:list')->everyMinute();

    // }

    protected $commands = [
        \App\Console\Commands\AutoLogoutUsers::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('expire:list')->everyMinute();
        // $schedule->command('command:auto-logout')->dailyAt('21:00')->timezone('Asia/Karachi');
        $schedule->command('command:auto-logout')->everyTwelveHours()->timezone('Asia/Karachi');
        // $schedule->command('command:auto-logout')->everyTwelveHours()->timezone('Asia/Karachi');

    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('users:auto-logout')->hourly();
    // }
}

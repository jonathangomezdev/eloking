<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('eloking:blog:post:scheduled:publish')->daily();
         $schedule->command('eloking:order:cleanup')->hourly();
         $schedule->command('eloking:discord:notify:readyForPickupOrders:still')->everyMinute();
         $schedule->command('eloking:orders:blockCompletedOrderChat')->hourly();
         $schedule->command('eloking:notification:on-email')->everyMinute();
         $schedule->command('eloking:database:backup')->dailyAt('03:00');
         $schedule->command('eloking:order:still-in-pickup')->everyMinute();
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
}

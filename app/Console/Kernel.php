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
        Commands\StatusUpdateInvoices::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('invoice:updatePastDue')->timezone('America/Los_Angeles')->dailyAt('00:15');
        $schedule->command('quote:overdue')->timezone('America/Los_Angeles')->dailyAt('00:15');
        $schedule->command('booking:reminder')->timezone('America/Los_Angeles')->dailyAt('00:30');
        $schedule->command('ft-expire-soon:send-email')->timezone('America/Los_Angeles')->dailyAt('8:30');
        $schedule->command('plan-expired:send-email')->timezone('America/Los_Angeles')->dailyAt('18:00');
        $schedule->command('expire:subscription')->timezone('America/Los_Angeles')->everyTwoHours();
        $schedule->command('quote:expire')->timezone('America/Los_Angeles')->everySixHours();
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

<?php

namespace PaladinsNinja\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use PaladinsNinja\Console\Commands\GetMatchesInQueue;
use PaladinsNinja\Console\Commands\GetAllChampions;
use PaladinsNinja\Console\Commands\GetInGameItems;

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
        // TODO: Whenever I get approval, update this.
        // $schedule->command(GetMatchesInQueue::class, [424])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [452])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [428])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [486])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [465])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [469])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [437])->cron('*/10 * * * *')->onOneServer();
        // $schedule->command(GetMatchesInQueue::class, [445])->cron('*/10 * * * *')->onOneServer();
        $schedule->command(GetAllChampions::class)->daily()->onOneServer();
        $schedule->command(GetInGameItems::class)->daily()->onOneServer();
        $schedule->command('horizon:snapshot')->everyFiveMinutes()->onOneServer();
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

<?php

namespace App\Console;

use Carbon\Carbon;
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
        // $schedule->command('save:counter')->dailyAt('05:00');
        $schedule->command('save:counter')->daily('05:00');
        //  ->before(function () {
        //      // Task is about to start...
        //      echo "Start at ". Carbon::now();
        //  })
        //  ->after(function () {
        //      // Task is complete...
        //      echo "End at ". Carbon::now();
        //  });

         // Scheduler H+1 Dashboard
         $schedule->command('save:counter2')->daily('05:30');
        //  ->before(function () {
        //      // Task is about to start...
        //      echo "Start at ". Carbon::now();
        //  })
        //  ->after(function () {
        //      // Task is complete...
        //      echo "End at ". Carbon::now();
        //  });
        $schedule->command('grab:edukasi')->daily('15:39');

        // Scheduler H+1 Dashboard
        //  $schedule->command('save:counter2')
        //  ->cron('0 5 * * */2')
        //  ->before(function () {
        //      // Task is about to start...
        //      echo "Start at ". Carbon::now();
        //  })
        //  ->after(function () {
        //      // Task is complete...
        //      echo "End at ". Carbon::now();
        //  });
         
        //  // Data Prospect
        //  $schedule->command('save:prospect')
        //  ->daily('04:00')
        //  ->before(function () {
        //      // Task is about to start...
        //      echo "Start at ". Carbon::now();
        //  })
        //  ->after(function () {
        //      // Task is complete...
        //      echo "End at ". Carbon::now();
        //  });
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

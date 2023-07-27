<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Inquiry;
use App\Models\Resident;
use App\Models\BusinessPermit;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            Inquiry::where('id', '!=', 0)->delete();
            Resident::whereNull('confirmed_at')->delete();
            BusinessPermit::whereNull('confirmed_at')->delete();
            BusinessPermit::whereNull('permit_status')->delete();
        })->timezone('Asia/Manila')
        ->monthly(); // everyMinute()
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

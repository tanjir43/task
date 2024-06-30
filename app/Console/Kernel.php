<?php

namespace App\Console;

use App\Mail\EventReminderMail;
use App\Models\Event;
use App\Models\EventReminder;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $reminders = EventReminder::with('event')
                ->where('reminder_time', '<=', Carbon::now())
                ->where('is_sent', false)
                ->get();
    
            foreach ($reminders as $reminder) {
                Mail::to($reminder->event->user->email)->send(new EventReminderMail($reminder, $reminder->event));
                #$reminder->is_sent = true;
                #$reminder->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

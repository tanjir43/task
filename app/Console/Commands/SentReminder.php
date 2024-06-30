<?php

use Illuminate\Console\Command;
use App\Models\EventReminder;
use App\Mail\EventReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature    = 'send:reminders';
    protected $description  = 'Send event reminders';

    public function __construct()
    {
        parent::__construct();
    }
  
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = EventReminder::with('event')->where('reminder_time', '<=', Carbon::now())->get();
        foreach ($reminders as $reminder) {
            Mail::to($reminder->event->user->email)->send(new EventReminderMail($reminder, $reminder->event));
            $reminder->delete();
        }
        $this->info('Reminders sent successfully.');
    }
}

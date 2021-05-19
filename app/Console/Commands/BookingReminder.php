<?php

namespace App\Console\Commands;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use App\Notifications\BookingReminderEmail;

class BookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sent reminder email to user and customer before 2 days of booking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        Log::info('STARTED: booking:reminder');
        $bookings = Booking::whereDate('start_date', '=', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->with('contact')->get();
        if($bookings->count() > 0) {
            foreach($bookings as $key=> $booking){
                if($booking->contact->email){
                    Notification::route('mail', [$booking->contact->email])->notify(new BookingReminderEmail($booking));
                }

            }
        }
        Log::info('FINISHED: booking:reminder: Booking reminder emails sent');
        $this->info('Booking reminder emails sent');
        return true;
    }
}

<?php

namespace App\Console\Commands;

use App\Quote;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Traits\Api\Common\NotificationTrait;
use Illuminate\Support\Facades\Log;

class OverDueQuote extends Command
{
    use NotificationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add notification if quote is passed valid through date';

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
        Log::info('STARTED: quote:overdue');
        $quote =  Quote::whereIn('quote_status_type_id', [2, 3])
                    ->where('valid_through', '=', Carbon::now()->subDays(1)->format('Y-m-d'))
                    ->where('is_archived',0)
                    ->with('contact')->get();

        if ($quote->count() > 0) {
            foreach ($quote as $key => $val) {
                $notification_link  =  '/user/quote-detail/' . $val->id;
                $notification_message = 'Quote for ' . $val->contact->first_name . ' ' . $val->contact->last_name.' has expired';
                $this->sendNotification($val->user_org_map_id, 'notification', $notification_link, $notification_message);
            }
        }

        Log::info('FINISHED: quote:overdue');
        $this->info('Quote Overdue notification added');
        return true;
    }
}

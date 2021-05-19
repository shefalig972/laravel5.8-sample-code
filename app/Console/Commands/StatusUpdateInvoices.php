<?php

namespace App\Console\Commands;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Traits\Api\Common\NotificationTrait;
use Illuminate\Support\Facades\Log;

class StatusUpdateInvoices extends Command
{
    use NotificationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:updatePastDue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status to past due in invoices';

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
        Log::info('STARTED: invoice:updatePastDue');
        $Invoices =  Invoice::whereIn('invoice_status_type_id',[2,3])->where('due_date','<', Carbon::now()->format('Y-m-d'))->with('contact')->get();
        Invoice::whereIn('invoice_status_type_id', [2, 3])->where('due_date', '<', Carbon::now()->format('Y-m-d'))->update([ 'invoice_status_type_id' => 4]);

        if($Invoices->count() > 0){
           foreach($Invoices as $key=>$val) {
                $notification_link  =  '/user/invoice-detail/' . $val->id;
                $notification_message = 'Payment overdue for ' . $val->contact->first_name . ' ' . $val->contact->last_name;
                $this->sendNotification($val->user_org_map_id, 'notification', $notification_link, $notification_message);
           }
        }
        Log::info('FINISHED: invoice:updatePastDue');
        $this->info('Status updated successfully');
    }
}

<?php

namespace App\Console\Commands;

use App\Quote;
use App\QuoteTimeline;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExpireQuoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the expired quotes status to rejected';

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
        Log::info('STARTED: quote:expire');
        DB::beginTransaction();
        # get all expired quotes which is not accepted/rejected
        $quotes = Quote::select('id','user_org_map_id','valid_through','valid_through_days','quote_status_type_id')
            ->whereIn('quote_status_type_id',[2,3,4])
            ->whereDate('valid_through','<', Carbon::now()->format('Y-m-d'))
            ->get();

        # update quote status type id to rejected and is_expired set to 1
        Quote::select('user_org_map_id','valid_through','valid_through_days','quote_status_type_id')
            ->whereIn('quote_status_type_id',[2,3,4])
            ->whereDate('valid_through','<', Carbon::now()->format('Y-m-d'))
            ->update(['quote_status_type_id' => 5, 'is_expired' => 1]);

        # add timeline to quotes.
        foreach ($quotes as $quote) {
            try {
                $quoteTimeline = QuoteTimeline::where('quote_id','=', $quote->id)->firstOrFail();
                $quoteTimeline->expired_on = Carbon::now()->format('Y-m-d');
                $quoteTimeline->save();
            } catch (\Exception $e) {
                $values = [
                    'quote_id' => $quote->id,
                    'expired_on' => Carbon::now()->format('Y-m-d'),
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                QuoteTimeline::insert($values);
            }
        }
        DB::commit();

        Log::info('FINISHED: quote:expire');

        return true;

    }
}

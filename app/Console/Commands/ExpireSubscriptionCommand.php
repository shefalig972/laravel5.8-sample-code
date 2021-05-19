<?php

namespace App\Console\Commands;

use App\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpireSubscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inactive those subscription whose plan expiration date is past.';

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
        Log::info('STARTED: expire:subscription');
        $yesterday = Carbon::now()->format('Y-m-d');
        $expiredSubscription = SubscribedUser::whereDate('plan_expiration_date','<', $yesterday)
            ->update(['is_active' => 0, 'subscription_status' => 'canceled']);

        Log::info('FINISHED: expire:subscription');
        return true;

    }
}

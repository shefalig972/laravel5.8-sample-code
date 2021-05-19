<?php

namespace App\Console\Commands;

use App\Notifications\FreeTrialExpiringSoon;
use App\Notifications\SubscriptionExpiringSoon;
use App\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FreeTrailExpirationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ft-expire-soon:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users whose Free Trial is expiring soon';

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
        Log::info('STARTED: ft-expire-soon:send-email');
        $twoDaysBefore = Carbon::now()->addDays(2);
        $expiringUsers = SubscribedUser::where('stripe_price_id','=', 'trail_plan')->whereDate('plan_expiration_date','=',$twoDaysBefore->format('Y-m-d'))->select('id','user_id')->with('user')->get();

        foreach ($expiringUsers as $expiringUser) {
            if ($expiringUser->user->status == 1) {
                Log::info('FreeTrailExpirationCommand: sending email to '.$expiringUser->user->email);
                $userName = $expiringUser->user->first_name ? $expiringUser->user->first_name : $expiringUser->user->email;
                $expiringUser->user->notify(new FreeTrialExpiringSoon($userName, $twoDaysBefore->format('M d, Y')));
            }
        }

        Log::info('FINISHED: ft-expire-soon:send-email');
        return true;
    }
}
<?php

namespace App\Console\Commands;

use App\Notifications\FreeTrialExpired;
use App\Notifications\SubscriptionExpired;
use App\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PlanExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan-expired:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification when subscription expired';

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
        Log::info('STARTED: plan-expired:send-email');
        try {
            $yesterday = Carbon::now()->subDays(1);
            $expiredUsers = SubscribedUser::whereDate('plan_expiration_date','=',$yesterday->format('Y-m-d'))->select('id','user_id', 'stripe_price_id')->with('user')->get();

            foreach ($expiredUsers as $expiredUser) {
                if ($expiredUser->user->status == 1) {
                    Log::info('PlanExpireCommand: sending email to '.$expiredUser->user->email);
                    $userName = $expiredUser->user->first_name ? $expiredUser->user->first_name : $expiredUser->user->email;
                    if ($expiredUser->stripe_price_id == 'trail_plan') {
                        $expiredUser->user->notify(new FreeTrialExpired($userName, $yesterday->format('M d, Y')));
                    }else{
                        $expiredUser->user->notify(new SubscriptionExpired($userName, $expiredUser->subscriptionPricingPlan->subscriptionProduct->stripe_product_name, $yesterday->format('M d, Y')));
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info('EXCEPTION: plan-expired:send-email: '.$e->getMessage());
        }

        Log::info('FINISHED: plan-expired:send-email');
        return true;
    }
}

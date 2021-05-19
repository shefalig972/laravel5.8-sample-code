<?php

use Illuminate\Database\Seeder;

class SubscriptionProcingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $values = [
            ['id' => 1, 'subscription_product_id' => 1, 'stripe_price_id' => 'trail_plan', 'plan_name' => 'Quarterly', 'plan_price' => 0, 'discount' => 0, 'final_price' => 0, 'interval' => 'month', 'interval_count' => 3, 'duration_days' => 90, 'is_recurring' => 0, 'is_active' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'subscription_product_id' => 2, 'stripe_price_id' => 'price_1ILk10HkA3ZUdXtwF9dUy48f', 'plan_name'=> 'Yearly', 'plan_price'=>100,'discount'=>0, 'final_price'=>100, 'interval'=> 'year', 'interval_count' => 1 ,'duration_days'=>365, 'is_recurring' => 0, 'is_active' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'subscription_product_id' => 2,  'stripe_price_id' => 'price_1ILk0rHkA3ZUdXtwJ8bc9ukc','plan_name' => 'Monthly', 'plan_price' => 50,'discount' => 0, 'final_price' => 50,'interval' => 'month', 'interval_count' => 1,'duration_days'=>30, 'is_recurring' => 0, 'is_active' => 1,  'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'subscription_product_id' => 2, 'stripe_price_id' => 'price_1ILk0cHkA3ZUdXtweRI840sM','plan_name' => 'Quarterly', 'plan_price' => 10,'discount' => 0, 'final_price' => 10, 'interval' => 'month', 'interval_count' => 3,'duration_days' => 90, 'is_recurring' => 0, 'is_active' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'subscription_product_id' => 3, 'stripe_price_id' => 'price_1IM5WTHkA3ZUdXtwpviMKLsy', 'plan_name' => 'Monthly', 'plan_price' => 40, 'discount' => 0, 'final_price' => 40, 'interval' => 'month', 'interval_count' => 2, 'duration_days' => 60, 'is_recurring' => 0, 'is_active' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'subscription_product_id' => 4, 'stripe_price_id' => 'price_1IM5oAHkA3ZUdXtwg25MEFzd', 'plan_name' => 'Monthly', 'plan_price' => 40, 'discount' => 0, 'final_price' => 40, 'interval' => 'month', 'interval_count' => 2, 'duration_days' => 60, 'is_recurring' => 0, 'is_active' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];
        \Illuminate\Support\Facades\DB::table('subscription_princing_plan')->insert($values);
    }
}

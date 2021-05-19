<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
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
            ['id' => 1, 'stripe_product_name' => 'Trail Plan', 'stripe_product_id' => 'trail-xyz', 'is_active' => 1,  'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'stripe_product_name'=>'Silver', 'stripe_product_id' => 'prod_IxfJojgm2kuiyF', 'is_active'=> 1,  'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,'stripe_product_name' => 'Gold',  'stripe_product_id' => 'prod_IxfJ9WprWosd7h','is_active' => 1,  'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,'stripe_product_name' => 'Platinum', 'stripe_product_id' => 'prod_IxeOY6J7O6kZuu','is_active' => 1,  'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
          
        ];
        \Illuminate\Support\Facades\DB::table('subscription_products')->insert($values);
    }
}

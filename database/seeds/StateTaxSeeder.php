<?php

use Illuminate\Database\Seeder;

class StateTaxSeeder extends Seeder
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
            ['id' => 1, 'stripe_tax_id' => 'txr_1INZHMHkA3ZUdXtwBaPbWOtp', 'state_name' => 'Florida, United States', 'tax_rate'=> 9,'description'=>null ,'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'stripe_tax_id' => 'txr_1INZH0HkA3ZUdXtwlCz3r7l8',  'state_name' => 'California, United States',  'tax_rate'=> 5,'description'=>null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'stripe_tax_id' => 'txr_1INYsrHkA3ZUdXtwep1XKzKL', 'state_name' => 'Alaska, United States', 'tax_rate'=> 10,'description'=>null, 'created_at' => $now, 'updated_at' => $now],

        ];
        \Illuminate\Support\Facades\DB::table('state_taxes')->insert($values);
    }
}

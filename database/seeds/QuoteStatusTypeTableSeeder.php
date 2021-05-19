<?php

use Illuminate\Database\Seeder;

class QuoteStatusTypeTableSeeder extends Seeder
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
            ['id' => 1, 'name' => 'New/Draft', 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Sent to Customer', 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Viewed by Customer', 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Revision Requested', 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Accepted/Rejected', 'created_by' => 1, 'updated_by' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];
        \Illuminate\Support\Facades\DB::table('quote_status_types')->insert($values);
    }
}

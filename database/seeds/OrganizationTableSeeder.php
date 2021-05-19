<?php

use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = [
            'id' => 1,
            'name' => 'Default',
            'email' => 'default@mybizzhive.com',
            'phone' => '0123456789',
            'license_no' => 'xxxx',
            'created_by' => null,
            'updated_by' => null,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];

        \DB::table('organizations')->insert($value);
    }
}

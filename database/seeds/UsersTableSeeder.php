<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
            'user_role_id' => 1,
            'org_id' => 1,
            'email' => 'admin@mybizzhive.com',
            'first_name' => 'Administrator',
            'password' => bcrypt('1234@4321'),
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];

        \DB::table('users')->insert($value);
    }
}

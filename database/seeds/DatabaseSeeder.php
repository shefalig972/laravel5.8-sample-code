<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesTableSeeder::class);
        $this->call(OrganizationTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(QuoteStatusTypeTableSeeder::class);
        $this->call(InvoiceStatusSeeder::class);
    }
}

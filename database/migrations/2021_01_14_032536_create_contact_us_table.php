<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->comment('This column contain  email Id of the user.');
            $table->string('first_name', 50)->comment('This column contain first name of the user.');
            $table->string('last_name', 50)->comment('This column contain last name of the user.');
            $table->string('phone', 20)->nullable()->comment('This column contain phone number of user');
            $table->string('reason', 255)->nullable()->comment('This column contain reason select by user.');
            $table->mediumText('info')->nullable()->comment('This column contain info in email');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}

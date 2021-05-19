<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('first_name', 50)->comment('This column contain first name of the contact.');
            $table->string('last_name', 50)->nullable()->comment('This column contain last name of the contact.');
            $table->string('email', 100)->nullable()->comment('This column contain email ID of the contact.');
            $table->string('phone_type',50)->nullable()->comment('Value of this column can be "Mobile", "Fixed" etc.');
            $table->string('phone',20)->nullable()->comment('This column contain phone no. of the contact.');
            $table->string('organization',100)->nullable()->comment('This column contain the organization name of the contact.');
            $table->string('title',100)->nullable()->comment('This column contain title of the contact.');
            $table->unsignedBigInteger('referred_by')->nullable()->comment('This column contains contact_id of the person(contact), who referred this contact.');
            $table->text('first_name_information')->nullable()->comment('This column contain details of the contact.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->unique(['user_org_map_id','email']);
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            $table->foreign('referred_by')->references('id')->on('contacts');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `contacts` comment 'This table contain the contacts created by users.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

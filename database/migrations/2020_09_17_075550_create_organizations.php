<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('This column contain the name of organization.');
            $table->string('email', 100)->comment('This column contain the email Id of organization.');
            $table->string('phone', 20)->comment('This column contain the phone number of organization.');
            $table->string('license_no',15)->nullable()->default(null)->unique()->comment('This column contain the licence no. of organization.');
            $table->string('company_logo')->nullable()->comment('This column contain URL of uploaded organization logo(image)');
            $table->string('website',100)->nullable()->comment('This column contain URL of organization website.');
            $table->string('street_address')->nullable()->comment('This column contain street address of the organization.');
            $table->string('city',50)->nullable()->comment('This column contain city name of the organization.');
            $table->string('state',100)->nullable()->comment('This column contain state name of the organization.');
            $table->string('zip',15)->nullable()->comment('This column contain postal zip code of the organization.');
            $table->string('country',100)->nullable()->comment('This column contain country name of the organization.');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('org_id')->on('organizations')->references('id');
        });

        \DB::statement("ALTER TABLE `organizations` comment 'This table contains the list of all organization details'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('name',100)->comment('This column contain name of the lead.');
            $table->unsignedFloat('potential_revenue',10,2)->nullable()->comment('This column contain potential revenue(amount) of the lead.');
            $table->string('interest_level',50)->nullable()->comment('This column contain interest level of the lead e.g "Tentative".');
            $table->string('event_type',15)->comment('The value of this column can be either "private" or "corporate".'); //Private and Corporate
            $table->unsignedBigInteger('service_type_id')->nullable()->comment('This column is a foreign key to services_types table. This represents the services provided by user/organization.');
            $table->string('when',100)->nullable()->comment('This column contain tentative day or week.');
            $table->string('location')->nullable()->comment('This column contain location related to the lead.');
            $table->string('lat_long',50)->nullable()->comment('This column contain latitude and longitude of location saved in "location" column. Latitude and Logitude values can be fetched from google location API.');
            $table->unsignedBigInteger('source_type_id')->nullable()->comment('This column is a foreign key to source_types table. Source types can be "Referred by", "Website" or "Other".');
            $table->unsignedBigInteger('contact_id')->nullable()->comment('This column is a foreign key to contacts table.');
            $table->unsignedBigInteger('referred_by')->nullable()->comment('This column is a foreign key to contacts table. This represents the person(contact) who referred this lead.');
            $table->string('website',100)->nullable()->comment('This column contain website URL related to the lead.');
            $table->unsignedBigInteger('lead_status_types_id')->comment('This column is a foreign key to lead_status_types table. This represents the user-defined stage name of the lead.');
            $table->unsignedFloat('amount',10,2)->nullable()->comment('This column will contain the lead amount when user move this lead to "Completed" stage.');
            $table->unsignedBigInteger('lead_lost_reason_id')->nullable()->comment('This column is a foreign key to lead_lost_reasons table. This represent the lost reason, when use move this lead to "Lost" stage.');
            $table->text('detail')->nullable()->comment('This column contain details of the lead.');
            $table->unsignedMediumInteger('position_in_status')->nullable()->comment('This column contains the position number of ticket in the given lead status');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
        Schema::table('leads', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('source_type_id')->references('id')->on('source_types');
            $table->foreign('referred_by')->references('id')->on('contacts');
            $table->foreign('lead_status_types_id')->references('id')->on('lead_status_types');
            $table->foreign('lead_lost_reason_id')->references('id')->on('lead_lost_reasons');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `leads` comment 'This table contains list of leads added by users.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}

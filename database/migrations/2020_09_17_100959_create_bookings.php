<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->unsignedBigInteger('contact_id')->nullable()->comment('This column is a foreign key to the contacts table. This represents the contact id for which this booking is created.');
            $table->unsignedBigInteger('service_type_id')->comment('This column is a foreign key to the service_types table. This represents the services provided by user/organization.');
            $table->string('name',100)->comment('This columns represents booking name');
            $table->string('event_type',15)->comment('The value of this column can be either "private" or "corporate".');
            $table->unsignedFloat('amount',10,2)->nullable()->comment('This column contain the total amount of the booking.');
            $table->unsignedFloat('received_amount',10,2)->nullable()->default(0)->comment('This column contain the amount received in advance for this booking.');
            $table->dateTime('start_date')->comment('This column contain the booking start date');
            $table->string('duration',50)->nullable()->comment('This column contain the duration of event (booking) eg. "3 Hours".');
            $table->mediumText('location')->nullable()->comment('This column contain the location of the event(Booking).');
            $table->string('lat_long',255)->nullable()->comment('This column contain the latitude and longitude of the location of event(Booking).');
            $table->unsignedBigInteger('source_type_id')->nullable()->comment('This column is a foreign key to source_types table. Source types can be "Referred by", "Website" or "Other".');
            $table->unsignedBigInteger('referred_by')->nullable()->comment('This column is a foreign key to contacts table. This represents the person(contact) who referred this lead.');
            $table->string('website',100)->nullable()->comment('This column contain website URL related to the lead.');
            $table->text('detail')->nullable()->comment('This column contain booking details');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('referred_by')->references('id')->on('contacts');
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('source_type_id')->references('id')->on('source_types');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `bookings` comment 'This table contain list of bookings created by users.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}

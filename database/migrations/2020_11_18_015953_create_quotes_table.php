<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('alpha_id', 100)->nullable()->unique()->comment('alpha numeric quote ID');
            $table->unsignedBigInteger('user_org_map_id');
            $table->unsignedBigInteger('contact_id')->comment('This quote created for this contact ID');
            $table->unsignedBigInteger('lead_id')->nullable()->default(null)->comment('This quote created for this Lead ID');
            $table->unsignedBigInteger('service_type_id')->nullable()->default(null)->comment('This column is a foreign key to services_types table. This represents the services provided by user/organization.');            
            $table->string('name')->comment('quote name');
            $table->dateTime('start_date')->nullable()->default(null)->comment('event start time');
            $table->string('event_duration', 20)->nullable()->default(null)->comment('event duration');
            $table->string('event_location', 255)->nullable()->default(null)->comment('event location address');
            $table->string('event_lat_long', 255)->nullable()->default(null)->comment('event location coordinates');
            $table->unsignedMediumInteger('quote_serial_no')->nullable()->comment('Quote serial number');
            $table->date('valid_through')->nullable()->default(null)->comment('quote valid upto date');
            $table->unsignedTinyInteger('quote_status_type_id')->nullable()->default(null)->comment('quote status');
            $table->unsignedFloat('amount_total', 10, 2)->nullable()->comment('quote total amount');
            $table->unsignedFloat('amount_deposit', 10, 2)->nullable()->comment('quote total paid amount');
            $table->unsignedFloat('amount_balance', 10, 2)->nullable()->comment('quote total balance amount');
            $table->tinyInteger('deposit_required')->default(0)->comment('deposit amount if required status 1 else 0');
            $table->tinyInteger('deposit_online')->default(0)->comment('deposit online amount if required status 1 else 0');            
            $table->string('access_code', 10)->nullable()->comment('access code to view quote');
            $table->text('internal_notes')->nullable()->comment('Internal notes on the quote');
            $table->string('accept_signatue', 255)->nullable()->default(null)->comment('user signature on accept quote');
            $table->string('reject_reason', 255)->nullable()->default(null)->comment('user reason on reject quote');
            $table->mediumText('revision')->nullable()->comment('user reason for revision');
            $table->tinyInteger('is_archived')->default(0)->comment('0 for not archived 1 for archived');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}

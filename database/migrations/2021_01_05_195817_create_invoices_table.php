<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->unsignedBigInteger('contact_id')->comment('This invoice created for this contact ID');
            $table->string('alpha_id', 100)->nullable()->unique()->comment('alpha numeric Invoice ID');
            $table->unsignedMediumInteger('invoice_serial_no')->nullable()->comment('Invoice serial number');           
            $table->unsignedTinyInteger('invoice_status_type_id')->nullable()->default(null)->comment('Invoice status');
            $table->unsignedBigInteger('invoice_template_id')->comment('This invoice created with this template ID')->nullable()->default(null);
            $table->unsignedBigInteger('quote_id')->nullable()->default(null)->comment('This invoice created for this Quote ID');
            $table->unsignedBigInteger('service_type_id')->nullable()->default(null)->comment('This column is a foreign key to services_types table. This represents the services provided by user/organization.');            
            $table->string('name')->comment('Invoice name');
            $table->date('due_date')->nullable()->default(null)->comment('Invoice due date');
            $table->dateTime('event_date')->nullable()->default(null)->comment('event date time for which this invoice is generated');
            $table->string('event_duration', 20)->nullable()->default(null)->comment('event duration');
            $table->string('event_location', 255)->nullable()->default(null)->comment('event location address');
            $table->string('event_lat_long', 255)->nullable()->default(null)->comment('event location coordinates');            
            $table->unsignedFloat('amount_total', 10, 2)->nullable()->comment('total amount Of Invoice');
            $table->unsignedFloat('amount_received', 10, 2)->nullable()->comment('Amount received as cash');
            $table->tinyInteger('deposit_received')->default(0)->comment('Allow user to add if already paid amount or not status 1 = yes 0 = no');       
            $table->unsignedFloat('amount_balance', 10, 2)->nullable()->comment('Invoice balance amount');
            $table->unsignedFloat('amount_paid', 10, 2)->nullable()->comment('Invoice paid online');
            $table->tinyInteger('amount_paid_manual')->default(0)->comment('Invoice amount paid by manually 1 = yes 0 = no');
            $table->unsignedFloat('tip_amount', 10, 2)->nullable()->comment('Total tip paid by user');
            $table->tinyInteger('allow_tip')->default(0)->comment('Allow user to add tip in invoice status 1 = yes 0 = no');
            $table->string('paid_by')->nullable()->default(null)->comment('Method by which invoice is paid');
            $table->string('accept_signature', 255)->nullable()->default(null)->comment('user signature on accept invoice');
            $table->tinyInteger('deposit_online')->default(0)->comment('deposit online amount if required status 1 else 0');
            $table->text('internal_notes')->nullable()->comment('Internal notes on the invoice');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
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
        Schema::dropIfExists('invoices');
    }
}

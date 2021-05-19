<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->enum('type', ['item_title', 'item_heading', 'item', 'fee', 'discount', 'section', 'email']);
            $table->string('item_heading_name', 255)->nullable()->default(null)->comment('item heading name');
            $table->string('item_heading_description', 255)->nullable()->default(null)->comment('item heading description');
            $table->string('item_heading_charges', 255)->nullable()->default(null)->comment('item heading charges');
            $table->string('item_name', 255)->nullable()->default(null)->comment('item name');
            $table->mediumText('item_description')->nullable()->default(null)->comment('item description');
            $table->string('item_charges', 255)->nullable()->default(null)->comment('item charges');
            $table->string('fee_name', 100)->nullable()->default(null)->comment('fee name');
            $table->unsignedFloat('fee', 10, 2)->nullable()->default(null)->comment('fee');
            $table->string('discount_name', 100)->nullable()->default(null)->comment('discount name');
            $table->unsignedFloat('discount', 10, 2)->nullable()->default(null)->comment('discount');
            $table->string('section_name', 255)->nullable()->default(null)->comment('section name');
            $table->text('section_description')->nullable()->default(null)->comment('section description');
            $table->string('email_to', 255)->nullable()->default(null)->comment('invoice sent to email');
            $table->string('email_from', 255)->nullable()->default(null)->comment('invoice send from email');
            $table->tinyInteger('send_email_copy_to_user')->default(0);
            $table->string('email_subject', 255)->nullable()->default(null)->comment('invoice email subject');
            $table->text('email_description')->nullable()->default(null)->comment('invoice email body');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('invoice_descriptions', function (Blueprint $table) {
            $table->foreign('invoice_id')->on('invoices')->references('id');
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
        Schema::dropIfExists('invoice_descriptions');
    }
}

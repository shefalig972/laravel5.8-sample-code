<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('payment_id')->nullable()->comment('transaction id received from paypal');
            $table->string('payer_email')->nullable()->comment('payer email id received from paypal');
            $table->string('payer_id')->nullable()->comment('payer id received from paypal');
            $table->string('payee_email')->nullable()->comment('payment receiver email id received from paypal');
            $table->string('merchant_id')->nullable()->comment('payment receiver merchant id receive from paypal');
            $table->unsignedFloat('amount_received', 10, 2)->nullable()->comment('amount received against quote ');
            $table->string('payment_status')->nullable()->default(null);
            $table->string('transaction_time')->nullable()->comment('The date and time when the transaction occurred');
            $table->text('payment_response');
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
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
        Schema::dropIfExists('test_payments');
    }
}

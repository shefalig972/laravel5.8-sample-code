<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_coupon_id', 100);
            $table->string('name', 100);
            $table->string('code', 15);
            $table->float('percent_off', 4, 2);
            $table->unsignedBigInteger('subscription_product_id')->nullable()->default(null);
            $table->date('redeem_by');
            $table->unsignedMediumInteger('duration_in_months');
            $table->boolean('status');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
        Schema::table('coupons', function (Blueprint $table) {
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
        Schema::dropIfExists('coupons');
    }
}

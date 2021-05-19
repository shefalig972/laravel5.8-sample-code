<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCouponColumnToSubscribedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribed_users', function (Blueprint $table) {
            $table->string('coupon_name',100)->nullable()->default(null)->after('plan_expiration_date');
            $table->string('coupon_code',20)->nullable()->default(null)->after('coupon_name');
            $table->string('stripe_coupon_id', 10)->nullable()->default(null)->after('coupon_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribed_users', function (Blueprint $table) {
            //
        });
    }
}

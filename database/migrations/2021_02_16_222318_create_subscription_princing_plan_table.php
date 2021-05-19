<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPrincingPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_product_id');
            $table->string('stripe_price_id');
            $table->string('plan_description',100)->nullable()->default(null);
            $table->decimal('plan_price',10,2)->comment('Base price of plan');
            $table->decimal('discount',10,2)->default(0);
            $table->decimal('final_price',10,2)->comment('final price after discount');
            $table->string('interval')->comment('recurring period of pricing plan');
            $table->integer('duration_days')->comment('Total number of days of plan');
            $table->tinyInteger('is_active')->default(0)->comment('1=> yes, 0=> no');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
        Schema::table('subscription_pricing_plans', function (Blueprint $table) {
            $table->foreign('subscription_product_id')->references('id')->on('subscription_products');
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
        Schema::dropIfExists('subscription_pricing_plans');
    }
}

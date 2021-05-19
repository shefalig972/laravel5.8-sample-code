<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribed_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('stripe_customer_id')->nullable()->comment('Stripe customer Id');
            $table->string('stripe_price_id')->comment('Plan pricing id');
            $table->string('stripe_tax_id')->nullable()->default(null)->comment('Stripe tax ID on this subscription');
            $table->string('stripe_subscription_id')->nullable()->comment('User Plan subscription id');
            $table->mediumText('response')->comment('Stripe response');
            $table->decimal('plan_price',10,2)->default(0)->comment('Plan price amount added');
            $table->decimal('state_tax',10,2)->default(0)->comment('State tax percentage value');
            $table->decimal('amount_paid',10,2)->default(0)->comment('amount paid by user');
            $table->tinyInteger('is_trail')->default(0)->comment('1=> yes, 0=> no');
            $table->tinyInteger('is_active')->default(0)->comment('1=> yes, 0=> no');
            $table->string('subscription_status', 100)->nullable()->default(null);
            $table->date('plan_start_date')->nullable()->default(null);
            $table->date('plan_expiration_date');
            $table->string('stripe_card_brand',10)->nullable()->default(null);
            $table->string('stripe_exp_month',2)->nullable()->default(null);
            $table->string('stripe_exp_year',4)->nullable()->default(null);
            $table->string('stripe_last4',4)->nullable()->default(null);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
        Schema::table('subscribed_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
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
        Schema::dropIfExists('subscribed_users');
    }
}

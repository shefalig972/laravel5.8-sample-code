<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_products', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_product_id');
            $table->string('stripe_product_name');
            $table->tinyInteger('is_active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');            
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
        Schema::dropIfExists('subscription_products');
    }
}

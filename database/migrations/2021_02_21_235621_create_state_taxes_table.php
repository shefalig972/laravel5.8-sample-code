<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_tax_id');
            $table->string('state_name')->comment('name of the U.S state');
            $table->decimal('tax_rate',10,2);
            $table->string('description')->default(null)->comment('optional for tax');
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
        Schema::dropIfExists('state_taxes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('name', 100);
            $table->string('description',255)->nullable()->comment('Description of quote');
            $table->unsignedFloat('amount_total', 10, 2)->nullable()->comment('quote total amount');
            $table->unsignedFloat('amount_deposit', 10, 2)->nullable()->comment('quote total paid amount');
            $table->unsignedFloat('amount_balance', 10, 2)->nullable()->comment('quote total balance amount');
            $table->text('quote_body')->nullable()->comment('Quote body in json string');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('quote_templates', function (Blueprint $table){
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
        Schema::dropIfExists('quote_templates');
    }
}

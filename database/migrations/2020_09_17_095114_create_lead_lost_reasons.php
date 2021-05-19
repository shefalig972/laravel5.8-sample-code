<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadLostReasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_lost_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->mediumText('name')->comment('This column contains lead lost reason added by user.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('lead_lost_reasons', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `lead_lost_reasons` comment 'This table contains list of lead lost reasons added by user.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_lost_reasons');
    }
}

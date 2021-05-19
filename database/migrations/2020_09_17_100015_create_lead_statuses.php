<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('lead_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lead_status_types_id');
            $table->unsignedInteger('amount')->nullable();
            $table->string('task_due_type',50)->nullable();
            $table->string('task_type',15)->nullable();
            $table->unsignedBigInteger('lead_lost_reason_id')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
        });

        Schema::table('lead_statuses', function (Blueprint $table) {
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lead_status_types_id')->references('id')->on('lead_status_types');
            $table->foreign('lead_lost_reason_id')->references('id')->on('lead_lost_reasons');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('lead_statuses');
    }
}

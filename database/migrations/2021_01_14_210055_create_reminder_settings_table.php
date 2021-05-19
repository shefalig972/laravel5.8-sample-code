<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->morphs('relation');
            $table->tinyInteger('customer_reminder_email')->default(0)->comment('email reminder required or not if user not pay quote or invoice 1= yes 0=no');
            $table->string('email_required_days',255)->nullable()->default(null)->comment('after how many days email reminder required');
            $table->date('email_date')->nullable()->default(null)->comment('email reminder date');
            $table->tinyInteger('email_sent')->default(0)->comment('if email reminder sent user not pay quote or invoice 1= yes 0=no');
            $table->tinyInteger('reminder_to_me')->default(0)->comment('email reminder required or not if user not pay quote or invoice 1= yes 0=no');
            $table->tinyInteger('view_email')->default(0)->comment('notification required when user see email  1= yes 0=no');
            $table->tinyInteger('revision_or_reject')->default(0)->comment('notification required on revision or reject quote or invoice 1= yes 0=no');
            $table->tinyInteger('accept')->default(0)->comment('notification required on accept quote or invoice 1= yes 0=no');
            $table->tinyInteger('not_signed')->default(0)->comment('notification required if not signed  quote or invoice 1= yes 0=no');
            $table->string('not_signed_days', 255)->nullable()->default(null)->comment('after how many days notification reminder required');     
            $table->date('not_signed_notification')->nullable()->default(null)->comment('notification reminder date');
            $table->date('not_signed_notification_sent')->nullable()->default(null)->comment('Check notification sent to user or not date 1= yes 0=no');            
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
        Schema::dropIfExists('reminder_settings');
    }
}

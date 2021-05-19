<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->tinyInteger('virtual_event')->after('event_type')->default(0)->comment('If user select meeting type to virtual');
            $table->string('meeting_id')->after('virtual_event')->nullable()->default(null)->comment('If  user select meeting type to virtual column save link of that');
            $table->string('passcode')->after('meeting_id')->nullable()->default(null)->comment('meeting passcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('virtual_event');
            $table->dropColumn('meeting_id');
            $table->dropColumn('passcode');
        });
    }
}

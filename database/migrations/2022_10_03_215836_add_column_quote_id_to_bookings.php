<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQuoteIdToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            /*$table->unsignedBigInteger('quote_id')->after('contact_id')->nullable()->comment('This booking created for this Quote ID');
            $table->foreign('quote_id')->references('id')->on('quotes');*/
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
            /*$table->dropColumn('quote_id');*/
        });
    }
}

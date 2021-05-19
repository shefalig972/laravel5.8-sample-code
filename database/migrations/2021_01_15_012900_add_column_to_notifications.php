<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->tinyInteger('is_read')->after('message')->default(0)->comment('Check notification os read or not');
            \DB::statement("ALTER TABLE `notifications` CHANGE `created_by` `created_by` BIGINT(20) UNSIGNED NULL");
            \DB::statement("ALTER TABLE `notifications` CHANGE `updated_by` `updated_by` BIGINT(20) UNSIGNED NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->dropColumn('is_read');
        });
    }
}

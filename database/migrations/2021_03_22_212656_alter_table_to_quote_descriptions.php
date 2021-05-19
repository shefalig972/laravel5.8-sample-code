<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableToQuoteDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_descriptions', function (Blueprint $table) {
            DB::statement("ALTER TABLE `quote_descriptions` CHANGE `type` `type` ENUM('item_title','item_heading','item','fee','discount','section','email','optional_item') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_descriptions', function (Blueprint $table) {
            //
        });
    }
}

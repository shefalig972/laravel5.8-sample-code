<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSendEmailCopyUserToQuoteDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_descriptions', function (Blueprint $table) {
            $table->tinyInteger('send_email_copy_to_user')->after('email_from')->default(0);
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
            $table->dropColumn('send_email_copy_to_user');
        });
    }
}

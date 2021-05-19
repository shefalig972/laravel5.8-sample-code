<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQuoteTemplateItToQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('quote_template_id')->comment('This quote created with this template ID')->after('user_org_map_id')->nullable()->default(null);
        });

         Schema::table('quotes', function (Blueprint $table) {
           $table->foreign('quote_template_id')->references('id')->on('quote_templates');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign('quotes_quote_template_id_foreign');
            $table->dropColumn('quote_template_id');
        });
    }
}

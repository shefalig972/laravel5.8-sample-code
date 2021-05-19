<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_timelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->timestamp('sent_at')->nullable()->default(null);
            $table->timestamp('viewed_at')->nullable()->default(null);
            $table->timestamp('revision_at')->nullable()->default(null);
            $table->timestamp('signed_at')->nullable()->default(null);
            $table->timestamp('reject_at')->nullable()->default(null);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('quote_timelines', function (Blueprint $table) {
            $table->foreign('quote_id')->on('quotes')->references('id');
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
        Schema::dropIfExists('quote_timelines');
    }
}

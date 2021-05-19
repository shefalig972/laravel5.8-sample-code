<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_types', function (Blueprint $table) {
            /*$table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('type', 20)->comment('The value of this column can be "Referred by", "website" or "other"');
            $table->string('value',100)->nullable()->default(null)->comment('The value of this column can we a website url or a custom source name added by user');
            $table->unsignedBigInteger('contact_id')->nullable()->default(null)->comment('The value of this column will a contact id, if user chooses "Referred By" value in "type" column.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();*/
            $table->id();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('name', 100)->comment('value os sources type other than Referred-by or website.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('source_types', function (Blueprint $table) {
            $table->foreign('user_org_map_id')->references('id')->on('user_org_maps');
            /*$table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');*/
        });

        \DB::statement("ALTER TABLE `source_types` comment 'This table will be used for lead sources while creating leads and bookings'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_sources');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrgMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_org_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('This column if foreign key to users table.');
            $table->unsignedBigInteger('organization_id')->comment('This column if foreign key to organizations table.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('user_org_maps', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('organization_id')->on('organizations')->references('id');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `user_org_maps` comment 'This table will provide \"map id\" of user with its organisation. This \"map id\" will help user to move to other organization without taking his leads/contacts with them.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_org_maps');
    }
}

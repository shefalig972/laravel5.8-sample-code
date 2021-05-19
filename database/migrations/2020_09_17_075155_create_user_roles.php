<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->string('name',20)->comment('This column will contain names of user roles like "Admin", "Customer" etc.');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `user_roles` comment 'This table contains all the user roles on the platform like admin and customer'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}

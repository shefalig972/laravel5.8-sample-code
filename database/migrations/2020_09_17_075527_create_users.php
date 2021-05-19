<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_role_id')->comment('This columns is foreign key to user_roles table and represents the role of user e.g "Admin" or "Customer".');
            $table->unsignedBigInteger('org_id')->comment('This columns is foreign key to organizations table and represents the organization to which user belongs to.');
            $table->string('email',100)->unique()->comment('This column contain unique email Id of the user.');
            $table->string('first_name',50)->nullable()->comment('This column contain first name of the user.');
            $table->string('last_name',50)->nullable()->comment('This column contain last name of the user.');
            $table->timestamp('email_verified_at')->nullable()->comment('This column represent if user has verified its email account. Value of this column will be a timestamp if the user has verified his email, otherwise value will be null.');
            $table->string('password',100)->comment('This column contain hashed password of the user account');
            $table->rememberToken()->comment('This column contain a token, that will help the platform to remember the user, in case user checked the "Remember me" checkbox during login.');
            $table->boolean('status')->default(0)->comment('If the value of this column is 0, this means the user is inactive, and if the value is 1 then user is active.');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('user_role_id')->references('id')->on('user_roles');
        });

        \DB::statement("ALTER TABLE `users` comment 'This table contains vital details as well as the credentials of registered customers (users).'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

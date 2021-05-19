<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->string('task_due_type',50)->comment('This column contain value task due eg. "In 2 Days".');
            $table->date('custom_date')->nullable()->comment('This column contain the date, if user want to enter specific date in "task due date".');
            $table->string('task_type',15)->comment('This column contain the task type eg. "To-do", "Follow up".');
            $table->unsignedBigInteger('refer_to')->nullable()->comment('This column is the foreign key to contact table.');
            $table->text('detail')->comment('This column contains the details of task.');
            $table->boolean('status')->default(0)->comment('This column contains the status of task open/completed.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });

        Schema::table('booking_tasks', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('refer_to')->references('id')->on('contacts');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
        });

        \DB::statement("ALTER TABLE `booking_tasks` comment 'This table contains the list of tasks created by user for their bookings.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_tasks');
    }
}

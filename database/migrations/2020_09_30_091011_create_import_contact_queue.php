<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportContactQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_contact_queues', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->index();
            $table->unsignedBigInteger('user_org_map_id');
            $table->string('first_name', 50)->comment('This column contain first name of the contact.');
            $table->string('last_name', 50)->nullable()->comment('This column contain last name of the contact.');
            $table->string('email', 100)->comment('This column contain email ID of the contact.');
            $table->string('phone_type',50)->nullable()->comment('Value of this column can be "Mobile", "Fixed" etc.');
            $table->string('phone',15)->nullable()->comment('This column contain phone no. of the contact.');
            $table->string('organization',100)->nullable()->comment('This column contain the organization name of the contact.');
            $table->string('title',100)->nullable()->comment('This column contain title of the contact.');
            $table->unsignedBigInteger('referred_by')->nullable()->comment('This column contains contact_id of the person(contact), who referred this contact.');
            $table->text('first_name_information')->nullable()->comment('This column contain details of the contact.');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_contact_queues');
    }
}

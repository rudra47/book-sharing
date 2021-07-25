<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('sender_id')->comment = 'pk of users.id';
            $table->integer('owner_id')->comment = 'pk of users.id';
            $table->tinyInteger('status')->comment = '0=Pending, 1=Accept, 2=Reject';
            $table->integer('created_by');
            $table->timestamp('status_update_time');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('valid')->comment = '1=Yes, 0=No';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_requests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEduStudentSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_student_social_links', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment = 'FK = users.id';
            $table->string('fb_link', 255)->nullable();
            $table->string('twitter_link', 255)->nullable();
            $table->string('linkedin_link', 255)->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('edu_student_social_links');
    }
}

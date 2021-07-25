<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEduBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_blog_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_id')->comment = 'fk of edu_blogs.id';
            $table->text('comment');
            $table->integer('status')->default(0)->comment = '0 = unpublish 1 = publish';
            $table->integer('created_by')->comment = 'fk of users.id';
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
        Schema::dropIfExists('edu_blog_comments');
    }
}

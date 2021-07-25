<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->comment = 'PK of book_categories.id';
            $table->string('book_id');
            $table->string('title');
            $table->text('summery');
            $table->integer('number_of_page');
            $table->integer('author_id')->comment = 'PK of authors.id';
            $table->integer('country_id')->comment = 'PK of countries.id';
            $table->integer('language_id')->comment = 'PK of languages.id';
            $table->integer('finished_reading')->nullable();
            $table->tinyInteger('available_status')->default(1)->comment = '1=available, 0=Not available';
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
        Schema::dropIfExists('books');
    }
}

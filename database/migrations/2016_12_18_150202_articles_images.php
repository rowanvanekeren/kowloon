<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
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
        Schema::drop('articles_images');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles_translations', function($table) {
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
        });
        Schema::table('articles_colors', function($table) {
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
        Schema::table('specifications_translations', function($table) {
            $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
        });
        Schema::table('faq_translations', function($table) {
            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('cascade');
        });
        Schema::table('categories_translations', function($table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        Schema::table('collection_translations', function($table) {
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

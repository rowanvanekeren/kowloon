<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('articles_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('collection_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('specification_id')->nullable();
            $table->string('locale');

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
        Schema::drop('articles_translations');
    }
}

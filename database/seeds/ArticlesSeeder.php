<?php

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->delete();



        $amount_of_repeats = 20;
        for ($i = 1; $i < $amount_of_repeats; $i++) {
            $article_row =
                array(
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'hot_item' => mt_rand(0,1)
                );
            DB::table('articles')->insert($article_row);
        }
    }
}

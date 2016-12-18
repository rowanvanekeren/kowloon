<?php

use Illuminate\Database\Seeder;

class ArticlesTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles_translations')->delete();


        $amount_of_repeats = 20;
        for ($i = 1; $i < $amount_of_repeats; $i++) {
            $random_category = mt_rand(1,6 );
            $random_collection = mt_rand(1,5 );

            $article_row_en = array(
                    'title'=>'COOLING MAT',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.',
                    'price' => 15.49,
                    'locale' => 'en',
                    'category_id' => $random_category,
                    'collection_id' =>$random_collection ,
                    'specification_id' => 1,
                    'article_id' => $i,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $article_row_nl = array(
                'title'=>'VERKOELENDE MAT',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.',
                'price' => 15.49,
                'locale' => 'nl',
                'category_id' => $random_category,
                'collection_id' =>$random_collection ,
                'specification_id' => 1,
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
            DB::table('articles_translations')->insert($article_row_en);
            DB::table('articles_translations')->insert($article_row_nl);
        }
    }
}

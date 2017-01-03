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
                    'tags' => 'default tag, english, en',
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
                'tags' => 'standaard tag, nederlands, nl',
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
            DB::table('articles_translations')->insert($article_row_en);
            DB::table('articles_translations')->insert($article_row_nl);

            DB::table('images')->delete();





        }
        $amount_of_repeats_image = 5;
        for ($im = 1; $im < $amount_of_repeats_image; $im++) {
            $image_id = $im;

            $image_row =
                array(
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('images')->insert($image_row);

            $image_row_en = array(
                'image' => 'standard.jpg',
                'description' => 'image description',
                'locale' => 'en',
                'image_id'=> $im
            );
            $image_row_nl = array(
                'image' => 'standard.jpg',
                'description' => 'foto beschrijving',
                'locale' => 'nl',
                'image_id'=> $im
            );
            DB::table('images_translations')->insert($image_row_en);
            DB::table('images_translations')->insert($image_row_nl);

            $amount_of_repeats = 20;
            for ($ai = 1; $ai < $amount_of_repeats; $ai++) {
                $image_row_ai = array(
                    'article_id' => $ai,
                    'image_id' => $im,
                    'order' => $im,

                );
                DB::table('articles_images')->insert($image_row_ai);
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles_colors')->delete();
        DB::table('colors')->delete();





            $color1 =
                array(
                    'hex' => 'fefefe',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $color2 =
            array(
                'hex' => '282828',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
            $color3 =
            array(
                'hex' => '2e49ab',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );

            DB::table('colors')->insert($color1);
            DB::table('colors')->insert($color2);
            DB::table('colors')->insert($color3);

        $amount_of_repeats = 20;
        for ($i = 1; $i < $amount_of_repeats; $i++) {
            $article_row1 =
                array(
                    'article_id' => $i,
                    'color_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $article_row2 =
                array(
                    'article_id' => $i,
                    'color_id' => 2,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $article_row3=
                array(
                    'article_id' => $i,
                    'color_id' => 3,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('articles_colors')->insert($article_row1);
            DB::table('articles_colors')->insert($article_row2);
            DB::table('articles_colors')->insert($article_row3);
        }
    }
}

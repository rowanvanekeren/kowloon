<?php

use Illuminate\Database\Seeder;

class ArticleFaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles_faqs')->delete();



        $amount_of_repeats = 20;
        for ($i = 1; $i < $amount_of_repeats; $i++) {
            $article_row =
                array(
                    'article_id' => $i,
                    'faq_id' => mt_rand(1,$amount_of_repeats -1 ),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('articles_faqs')->insert($article_row);
        }

        $user_row =
            array(
                'name' => 'rowan',
                'email' => 'admin@admin.be',
                'password' => Hash::make(123456),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('users')->insert($user_row);


    }
}

<?php

use Illuminate\Database\Seeder;

class FaqTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq_translations')->delete();
        $amount_of_repeats = 20;
        for ($i = 1; $i < $amount_of_repeats; $i++) {
            $faq_row_en =
                array(
                    'question' => 'This is an english question?',
                    'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.',
                    'locale' => 'en',
                    'faq_id' => $i,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_nl =
                array(
                    'question' => 'Dit is een nederlandse vraag?',
                    'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.',
                    'locale' => 'nl',
                    'faq_id' => $i,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );

            DB::table('faq_translations')->insert($faq_row_en);
            DB::table('faq_translations')->insert($faq_row_nl);
        }
    }
}

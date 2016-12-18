<?php

use Illuminate\Database\Seeder;

class SpecificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specifications_translations')->delete();
        DB::table('specifications')->delete();

        $spec_row =
            array(
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('specifications')->insert($spec_row);

        $i = 1;
            $faq_row_en1 =
                array(
                    'dimension' => '53x18',
                    'size' => 's',
                    'description' =>'this is an description',
                    'specification_id' => $i,
                    'locale' => 'en',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_en2 =
                array(
                    'dimension' => '53x18',
                    'size' => 'm',
                    'description' =>'this is an description',
                    'specification_id' => $i,
                    'locale' => 'en',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_en3 =
                array(
                    'dimension' => '53x18',
                    'size' => 'l',
                    'description' =>'this is an description',
                    'specification_id' => $i,
                    'locale' => 'en',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_nl1 =
                array(
                    'dimension' => '53x18',
                    'size' => 's',
                    'description' =>'dit is een omschrijving',
                    'specification_id' => $i,
                    'locale' => 'nl',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_nl2 =
                array(
                    'dimension' => '53x18',
                    'size' => 'm',
                    'description' =>'dit is een omschrijving',
                    'specification_id' => $i,
                    'locale' => 'nl',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            $faq_row_nl3 =
                array(
                    'dimension' => '53x18',
                    'size' => 'l',
                    'description' =>'dit is een omschrijving',
                    'specification_id' => $i,
                    'locale' => 'nl',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('specifications_translations')->insert($faq_row_en1);
            DB::table('specifications_translations')->insert($faq_row_en2);
            DB::table('specifications_translations')->insert($faq_row_en3);
            DB::table('specifications_translations')->insert($faq_row_nl1);
            DB::table('specifications_translations')->insert($faq_row_nl2);
            DB::table('specifications_translations')->insert($faq_row_nl3);

    }
}

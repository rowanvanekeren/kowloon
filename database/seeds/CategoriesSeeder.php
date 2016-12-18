<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_translations')->delete();

        DB::table('categories')->delete();
        for($i=0; $i<6 ;$i++){
            $category_row_ind =
                array(
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('categories')->insert($category_row_ind);
        }



        $categories_en = array(
            'Dogs',
            'Cats',
            'Fish',
            'Birds',
            'Small Animals',
            'Other',
        );
        $categories_nl = array(
            'Honden',
            'Katten',
            'Vissen',
            'Volges',
            'Kleine Dieren',
            'Overige',
        );

        $i_en = 1;
        $i_nl = 1;
        foreach ($categories_en as $category) {
            $category_row =
                array(
                    'type' => $category,
                    'locale' => 'en',
                    'category_id' => $i_en,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('categories_translations')->insert($category_row);
            $i_en++;
        }
        foreach ($categories_nl as $category) {
            $category_row =
                array(
                    'type' => $category,
                    'locale' => 'nl',
                    'category_id' =>$i_nl,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('categories_translations')->insert($category_row);
            $i_nl++;
        }
    }
}

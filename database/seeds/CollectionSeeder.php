<?php

use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collection')->delete();
        DB::table('collection_translations')->delete();
        for($i=0; $i<5 ;$i++){
            $collection_row_ind =
                array(
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('collection')->insert($collection_row_ind);
        }


        $collections_en = array(
            "Splash 'n Fun",
            'Luxury',
            'new',
            'on sale',
            'other'
        );
        $collections_nl = array(
            "Plons en Plezier",
            'luxe',
            'nieuw',
            'aanbieding',
            'andere'
        );

        $i_en = 1;
        $i_nl = 1;
        foreach ($collections_en as $collection) {
            $collection_row_en =
                array(
                    'type' => $collection,
                    'locale' => 'en',
                    'collection_id' => $i_en,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('collection_translations')->insert($collection_row_en);
            $i_en++;
        }

        foreach ($collections_nl as $collection) {
            $collection_row_nl =
                array(
                    'type' => $collection,
                    'locale' => 'nl',
                    'collection_id' =>$i_nl ,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('collection_translations')->insert($collection_row_nl);
            $i_nl++;
        }
    }
}

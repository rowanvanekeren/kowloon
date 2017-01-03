<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call(CategoriesSeeder::class);
         $this->call(CollectionSeeder::class);

         $this->call(FaqSeeder::class);
         $this->call(FaqTransSeeder::class);
        $this->call(SpecificationsSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(ArticlesTransSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ArticleFaqSeeder::class);
    }
}

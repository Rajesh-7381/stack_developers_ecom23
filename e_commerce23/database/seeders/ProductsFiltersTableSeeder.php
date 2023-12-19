<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsFiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // Change 10 to the number of rows you want to generate
            DB::table('products_filters')->insert([
                'filter_name' => $faker->word, // Change 'word' to the desired data type for filter_name
                'filter_value' => $faker->word, // Change 'word' to the desired data type for filter_value
                'sort' => $faker->numberBetween(1, 100), // Change the range as needed for sort
                'status' => $faker->numberBetween(0, 1), // Assuming status is a boolean field
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // or 
        // $productimageRecords=[
        //     ['id'=>1,'filter_name'=>1,'filter_value'=>'1.jpg','sort'=>1, 'status'=>1],
       
        // ];
        // produ::insert($productimageRecords);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductFilter;
use App\Models\productFilters;
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
        // $faker = Faker::create();

        // for ($i = 0; $i < 10; $i++) { // Change 10 to the number of rows you want to generate
        //     DB::table('products_filters')->insert([
        //         'filter_name' => $faker->word, // Change 'word' to the desired data type for filter_name
        //         'filter_value' => $faker->word, // Change 'word' to the desired data type for filter_value
        //         'sort' => $faker->numberBetween(1, 100), // Change the range as needed for sort
        //         'status' => $faker->numberBetween(0, 1), // Assuming status is a boolean field
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        // or 
        $productimageRecords=[
            ['id'=>11,'filter_name'=>'fabric','filter_value'=>'cotton','sort'=>1, 'status'=>1],
            ['id'=>12,'filter_name'=>'fabric','filter_value'=>'polyster','sort'=>1, 'status'=>1],
            ['id'=>13,'filter_name'=>'fabric','filter_value'=>'wool','sort'=>1, 'status'=>1],
            ['id'=>14,'filter_name'=>'sleeve','filter_value'=>'full sleve','sort'=>1, 'status'=>1],
            ['id'=>15,'filter_name'=>'sleeve','filter_value'=>'half sleve','sort'=>2, 'status'=>1],
            ['id'=>16,'filter_name'=>'sleeve','filter_value'=>'sort sleve','sort'=>3, 'status'=>1],
            ['id'=>17,'filter_name'=>'pattern','filter_value'=>'checked','sort'=>1, 'status'=>1],
            ['id'=>18,'filter_name'=>'pattern','filter_value'=>'plain','sort'=>2, 'status'=>1],
            ['id'=>19,'filter_name'=>'pattern','filter_value'=>'printed','sort'=>3, 'status'=>1],
            ['id'=>20,'filter_name'=>'fit','filter_value'=>'regular','sort'=>4, 'status'=>1],
            ['id'=>21,'filter_name'=>'fit','filter_value'=>'slim','sort'=>5, 'status'=>1],
            ['id'=>22,'filter_name'=>'occassion','filter_value'=>'casual','sort'=>5, 'status'=>1],
            ['id'=>23,'filter_name'=>'occassion','filter_value'=>'formal','sort'=>5, 'status'=>1],
       
        ];
        productFilters::insert($productimageRecords);
    }
}

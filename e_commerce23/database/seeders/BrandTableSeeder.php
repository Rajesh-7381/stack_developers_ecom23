<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $brandRecords = [

            [   'id'=>1,
                'brand_name' => 'Brand 1',
                'brand_image' => 'image1.jpg',
                'brand_logo' => 'logo1.jpg',
                'brand_discount' => 10.5,
                'description' => 'Description for Brand 1',
                'url' => 'brand1-url',
                'meta_title' => 'Brand 1 Title',
                'meta_description' => 'Brand 1 Description',
                'meta_keywords' => 'keyword1, keyword2',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=>2,
                'brand_name' => 'Brand 21',
                'brand_image' => 'image12.jpg',
                'brand_logo' => 'logo12222.jpg',
                'brand_discount' => 10.5,
                'description' => 'Description for Brand 1',
                'url' => 'brand1-url',
                'meta_title' => 'Brand 122 Title',
                'meta_description' => 'Brand 122 Description',
                'meta_keywords' => 'keyword1222, keyword2222',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=>3,
                'brand_name' => 'Brand 2',
                'brand_image' => 'image2.jpg',
                'brand_logo' => 'logo2.jpg',
                'brand_discount' => 10.5,
                'description' => 'Description for Brand 21',
                'url' => 'brand1-url',
                'meta_title' => 'Brand 2 Title',
                'meta_description' => 'Brand 2 Description',
                'meta_keywords' => 'keyword12, keyword22',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=>4,
                'brand_name' => 'Brand 94588582',
                'brand_image' => 'image94588582.jpg',
                'brand_logo' => 'logo29458858.jpg',
                'brand_discount' => 10.5,
                'description' => 'Description for Brand 945885821',
                'url' => 'brand1-url',
                'meta_title' => 'Brand 29458858 Title',
                'meta_description' => 'Brand 94588582 Description',
                'meta_keywords' => 'keyword194588582, keyword294588582',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=>5,
                'brand_name' => 'Brand 847572',
                'brand_image' => 'image847572.jpg',
                'brand_logo' => 'logo284757.jpg',
                'brand_discount' => 10.5,
                'description' => 'Description for Brand 2847571',
                'url' => 'brand1-url',
                'meta_title' => 'Brand 284757 Title',
                'meta_description' => 'Brand 2 Description',
                'meta_keywords' => 'keyword8475712, keyword2847572',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more brands if needed
        ];
        Brand::insert($brandRecords);
    }
}

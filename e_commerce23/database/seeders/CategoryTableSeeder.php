<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoryRecords=[
            [
                'id'=>1,
                'parent_id' => 0,
                'category_name' => 'clothing',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ],
            [
                'id'=>2,
                'parent_id' => 0,
                'category_name' => 'electronics',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ],
            [
                'id'=>3,
                'parent_id' => 0,
                'category_name' => 'men',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ],
            [
                'id'=>4,
                'parent_id' => 0,
                'category_name' => 'women',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ],
            [
                'id'=>5,
                'parent_id' => 0,
                'category_name' => 'Sample Category 1',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ],
            [
                'id'=>6,
                'parent_id' => 0,
                'category_name' => 'kid',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is a sample description for category 1.',
                'url' => 'sample-category-1',
                'meta_title' => 'Category 1 Meta Title',
                'meta_description' => 'Category 1 Meta Description',
                'meta_keyword' => 'Category 1, Sample, Dummy',
                'status' => 1,
              
            ]
        ];
        Category::insert($categoryRecords);
    }
}

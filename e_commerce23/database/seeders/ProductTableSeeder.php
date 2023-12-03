<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productsTable=[[
            'id' => 1,
            'category_id' => 8,
            'brand_id' => 8,
            'product_name' =>'t-shirt',
            'product_code' => 'BT001',
            'product_color' => 'red',
            'family_color' => 'yellow',
            'group_code' => 'TSHIRT001',
            'product_weight' => 500,
            'product_price' => 1500,
            'product_discount' =>'10',
            'discount_type' => 'product',
            'final_price' =>'1350',
            'product_video' => '',
            'description' => 'test',
            'washcare' => '',
            'keywords' =>'' ,
            'fabric' =>'' ,
            'pattern' =>'',
            'sleeve' =>'' ,
            'fit' => '',
            'occassion' =>'',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'is_featured' =>'Yes' ,
            'status' =>1,
            'created_at' => now(),
            'updated_at' => now(),
    ],
    [
        'id' => 2,
        'category_id' => 8,
        'brand_id' => 8,
        'product_name' =>'t-shirt',
        'product_code' => 'BT001',
        'product_color' => 'red',
        'family_color' => 'yellow',
        'group_code' => 'TSHIRT001',
        'product_weight' => 500,
        'product_price' => 1500,
        'product_discount' =>'10',
        'discount_type' => 'product',
        'final_price' =>'1350',
        'product_video' => '',
        'description' => 'test',
        'washcare' => '',
        'keywords' =>'' ,
        'fabric' =>'' ,
        'pattern' =>'',
        'sleeve' =>'' ,
        'fit' => '',
        'occassion' =>'',
        'meta_title' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'is_featured' =>'Yes' ,
        'status' =>1,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 3,
        'category_id' => 8,
        'brand_id' => 8,
        'product_name' =>'t-shirt',
        'product_code' => 'BT001',
        'product_color' => 'red',
        'family_color' => 'yellow',
        'group_code' => 'TSHIRT001',
        'product_weight' => 500,
        'product_price' => 1500,
        'product_discount' =>'10',
        'discount_type' => 'product',
        'final_price' =>'1350',
        'product_video' => '',
        'description' => 'test',
        'washcare' => '',
        'keywords' =>'' ,
        'fabric' =>'' ,
        'pattern' =>'',
        'sleeve' =>'' ,
        'fit' => '',
        'occassion' =>'',
        'meta_title' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'is_featured' =>'Yes' ,
        'status' =>1,
        'created_at' => now(),
        'updated_at' => now(),
    ]];
    Products::insert($productsTable);
    }
}

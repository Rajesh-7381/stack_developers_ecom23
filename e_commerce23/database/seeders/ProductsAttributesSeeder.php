<?php

namespace Database\Seeders;

use App\Models\ProductsAttributes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productsdataRecords=[
            ['id'=>1,'product_id'=>1,'size'=>'large','sku'=>'BT0015' ,'price'=>1200,'stock'=>100 ,'status'=>1],
            ['id'=>2,'product_id'=>3,'size'=>'medium','sku'=>'BT0015' ,'price'=>1400,'stock'=>80 ,'status'=>1],
            ['id'=>3,'product_id'=>3,'size'=>'small','sku'=>'BT0015' ,'price'=>1600,'stock'=>50 ,'status'=>1],
         
        ];
        ProductsAttributes::insert($productsdataRecords);
    }
}

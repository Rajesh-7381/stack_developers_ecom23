<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttributes extends Model
{
    use HasFactory;
    protected $table="products_attributes";

    public static function productStock($product_id,$size){
        $productStock=ProductsAttributes::select('stock')->where(['product_id'=>$product_id,'size'=>$size])->first();
        return $productStock->stock;
    }
}

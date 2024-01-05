<?php

namespace App\Models;
// namespace App\category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->with('parentcategory');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public static function productsfilter()
    {
        // productsfilter
        $productsfilter['fabricArray'] = array('cotton', 'polyster', 'wool');
        $productsfilter['SleeveArray'] = array('full sleve', 'half sleve', 'short sleve', 'sleve less');
        $productsfilter['PatternArray'] = array(' checked', 'plain ', 'printed ', 'self ', 'solid');
        $productsfilter['FitArray'] = array(' regular', 'slim ');
        $productsfilter['OccasionArray'] = array(' casual', 'formal ');
        return $productsfilter;
    }
    public function images()
    {
        return $this->hasMany(ProductsImage::class, 'product_id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductsAttributes::class, 'product_id');
    }
    public static function getAttributePrice($product_id, $size)
    {
        $attributeprice = ProductsAttributes::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        // for getting product discount
        $prodctDetails = Products::select(['product_discount', 'category_id', 'brand_id'])->where('id', $product_id)->first()->toArray();
        // for getting category discount
        $categoryDetails = Category::select(['category_discount'])->where('id', $prodctDetails['category_id'])->first()->toArray();
        // for getting brand discount
        $brandDetails = Brand::select(['brand_discount'])->where('id', $prodctDetails['brand_id'])->first()->toArray();
        // dd($attributeprice);


        if ($prodctDetails['product_discount'] > 0) {
            // 1st case if there is any product discount
            $discount = $attributeprice['price'] * $prodctDetails['product_discount'] / 100;
            $discount_percent=$prodctDetails['product_discount'];
            $final_price = $attributeprice['price'] - $discount;
        } else if ($categoryDetails['category_discount'] > 0) {
            // 1st case if there is any category discount
            $discount = $attributeprice['price'] * $prodctDetails['category_discount'] / 100;
            $discount_percent=$prodctDetails['category_discount'];
            $final_price = $attributeprice['price'] - $discount;
        } else if ($brandDetails['brand_discount'] > 0) {
            // 1st case if there is any brand discount
            $discount = $attributeprice['price'] * $prodctDetails['brand_discount'] / 100;
            $discount_percent=$prodctDetails['brand_discount'];
            $final_price = $attributeprice['price'] - $discount;
        }else{
            // if there is no discount
            $discount=0;
            $discount_percent=0;
            $final_price=$attributeprice['price'];
        }
        return array('product_price'=>$attributeprice['price'],'final_price'=>$final_price,'discount'=>$discount,'discount_percent'=>$discount_percent);
        
    }
    public static function productstatus($product_id){
        $productstatus=Products::select('status')->where('id',$product_id)->first();
        return $productstatus->status;
    }
}

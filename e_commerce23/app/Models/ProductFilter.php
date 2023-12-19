<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;
    public static function getcolors($catIds){
        $getProdutsIds=Products::select('id')->whereIn('category_id',$catIds)->pluck('id');
        // dd($getProdutsIds);
        $getProdutcolors=Products::select('family_color')->whereIn('id',$getProdutsIds)->groupBy('family_color')->pluck('family_color');
        // dd($getProdutcolors);
        return $getProdutcolors;
    }
    public static function getSize($catIds){
        $getProdutsIds=Products::select('id')->whereIn('category_id',$catIds)->pluck('id');
        $getProdutsizes=ProductsAttributes::select('size')->where('status',1)->whereIn('product_id',$getProdutsIds)->groupBy('size')->pluck('size');
        // dd($getProdutsizes);
        return $getProdutsizes;
    }
    public static function getBrands($catIds){
        $getProdutsIds=Products::select('id')->whereIn('category_id',$catIds)->pluck('id');
        $getProductBrandsIds=Products::select('brand_id')->where('status',1)->whereIn('id',$getProdutsIds)->groupBy('brand_id')->pluck('brand_id');
        $getProductBrands=Brand::select('id','brand_name')->where('status',1)->whereIn('id',$getProductBrandsIds)->orderBy('brand_name','ASC')->get()->toArray();

        // dd($getProductBrands);
        return $getProductBrands;
    }
}

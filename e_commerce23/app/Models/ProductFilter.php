<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ProductFilter extends Model
{
    use HasFactory;
    public static function getcolors($catIds)
    {
        $getProdutsIds = Products::select('id')->whereIn('category_id', $catIds)->pluck('id');
        // dd($getProdutsIds);
        $getProdutcolors = Products::select('family_color')->whereIn('id', $getProdutsIds)->groupBy('family_color')->pluck('family_color');
        // dd($getProdutcolors);
        return $getProdutcolors;
    }
    public static function getSize($catIds)
    {
        $getProdutsIds = Products::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $getProdutsizes = ProductsAttributes::select('size')->where('status', 1)->whereIn('product_id', $getProdutsIds)->groupBy('size')->pluck('size');
        // dd($getProdutsizes);
        return $getProdutsizes;
    }
    public static function getBrands($catIds)
    {
        $getProdutsIds = Products::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $getProductBrandsIds = Products::select('brand_id')->where('status', 1)->whereIn('id', $getProdutsIds)->groupBy('brand_id')->pluck('brand_id');
        $getProductBrands = Brand::select('id', 'brand_name')->where('status', 1)->whereIn('id', $getProductBrandsIds)->orderBy('brand_name', 'ASC')->get()->toArray();

        // dd($getProductBrands);
        return $getProductBrands;
    }
    public static function getDynamicFilters($catIds)
    {
        $getProdutsIds = Products::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $getFiltersColumns = productFilters::select('filter_name')->pluck('filter_name')->toArray();
        if (count($getFiltersColumns) > 0) {
            $getFiltervalues = Products::select($getFiltersColumns)->whereIn('id', $getProdutsIds)->where('status', 1)->get()->toArray();
        } else {
            $getFiltervalues = Products::whereIn('id', $getProdutsIds)->where('status', 1)->get()->toArray();
        }
        $getFiltervalues = array_filter(array_unique(Arr::flatten($getFiltervalues)));
        // dd($getFiltervalues);
        $getcategoryFiltersColumns = ProductFilters::select('filter_name')->whereIn('filter_value', $getFiltervalues)->orderBy('sort', 'ASC')->where('status', 1)->pluck('filter_name')->toArray();
        // dd($getcategoryFiltersColumns);
        return $getcategoryFiltersColumns;
    }
    public static function selectedFilters($filter_name, $catIds)
    {
        $productFilters = Products::select($filter_name)->whereIn('category_id', $catIds)->groupBy($filter_name)->get()->toArray();
        $productFilters = array_filter(Arr::flatten($productFilters));
        return $productFilters;
    }
    public static function  filterTypes(){
        $filterTypes=productFilters::select('filter_name')->groupBy('filter_name')->where('status',1)->get()->toArray();
        $filterTypes=Arr::flatten($filterTypes);

        // dd($filterTypes);
        return $filterTypes;
    }
}

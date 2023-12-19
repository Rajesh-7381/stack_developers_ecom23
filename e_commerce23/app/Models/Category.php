<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table name associated with this model
    protected $table = 'categories';

    /**
     * Relationship: Get the parent category of the current category.
     * A category has one parent category.
     * Selects specific columns: id, category_name, url
     * Conditions: Status must be 1 (active).
     */
    public function parentcategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')
            ->select('id', 'category_name', 'url')
            ->where('status', 1);
    }

    /**
     * Relationship: Get the subcategories belonging to the current category.
     * A category can have multiple subcategories.
     * Conditions: Status must be 1 (active).
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')
            ->where('status', 1);
    }

    /**
     * Static method to fetch categories along with their subcategories.
     * Fetches categories with parent_id as 0 (top-level categories) and status as 1 (active).
     * Converts the results to an array and dumps them for demonstration.
     */
    // public static function getcategories()
    // {
    //     // Retrieve categories with their subcategories where the parent_id is 0 and status is 1
    //     $getcategories = Category::with('subcategories')
    //         ->where('parent_id', 0)
    //         ->where('status', 1)
    //         ->get()
    //         ->toArray();

    //     // Output the fetched categories (for demonstration purposes)
    //     // dd($getcategories);
    //     return $getcategories;
    // }
    public static function getcategories()
    {
        // Retrieve categories with their subcategories where the parent_id is 0 and status is 1
        $getcategories = Category::with(['subcategories' => function ($query) {
            $query->with('subcategories');
        }])
            ->where('parent_id', 0)
            ->where('status', 1)
            ->get()
            ->toArray();

        // Output the fetched categories (for demonstration purposes)
        // dd($getcategories);
        return $getcategories;
    }

    // frontend 
//     public static function categoryDetails($url)
// {
//     $categoryDetails = Category::select('id', 'category_name', 'url')
//         ->with('subcategories')
//         ->where('url', $url)
//         ->first();
//         // echo "<pre>";print_r($categoryDetails);die;
//         // dd($categoryDetails);

//     return $categoryDetails; // Return the fetched category details
// }
public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'category_name','parent_id','url')->with('subcategories')->where('url', $url)->first()->toArray();
        //  here is the example to search dynamic category url         (http://127.0.0.1:8000/sample-category-1) replace sample-category-1 to paste actual url
        // echo "<pre>";print_r($categoryDetails);die;
        
        // dd($categoryDetails);
        $catIds=array();
        $catIds[]=$categoryDetails['id'];
        // dd($catIds);
        foreach($categoryDetails['subcategories'] as $subcat){
            $catIds[]=$subcat['id'];
        }
        // parent_id 0,1,2,3 we dont show any parent category
        if($categoryDetails['parent_id']==0 || $categoryDetails['parent_id']==1 || $categoryDetails['parent_id']==2 || $categoryDetails['parent_id']==3){
            // only show main category in breadcrumbs
            $breadcrumbs = '<a class="gl-tag btn--e-brand-shadow" href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a>';
            // dd($breadcrumbs);
        }else{
            // show main and subcategory in breadcrumb
            $parentCategory=Category::select('category_name','url')->where('id',$categoryDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a class="gl-tag btn--e-brand-shadow" href="' . url($parentCategory['url']) . '">' . $parentCategory['category_name'] . '</a>
            <a class="gl-tag btn--e-brand-shadow" href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a>';
            // dd($breadcrumbs);

        }

        // return $categoryDetails;
        return array('catIds'=>$catIds,'categoryDetails'=>$categoryDetails,'breadcrumbs'=>$breadcrumbs);
       
    }

}

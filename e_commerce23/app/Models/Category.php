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
        $getcategories = Category::with(['subcategories'=>function($query){
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
}

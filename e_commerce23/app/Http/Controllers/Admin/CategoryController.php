<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AdminsModel;
use Illuminate\Support\Facades\Auth; // Import the Auth facade if not already imported

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    //
    public function categories()
    {

        $categories = Category::with('parentcategory')->get();
        // dd($categories);
        $categoriescount=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
        $categoriesmodule=array();
        if(Auth::guard('admin')->user()->type=='admin'){
            $categoriesmodule['view_acess']=1;
            $categoriesmodule['edit_acess']=1;
            $categoriesmodule['full_acess']=1;
        }else if($categoriescount==0){
            $message="this feature restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $categoriesmodule=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
        }
        return view('admin.categories.categories')->with(compact('categories','categoriesmodule'));
    }

    public function updatecategorystatus(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function deletecategory($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'deleted successfully');
    }
    
        public function addedit(Request $request, $id = null)
        {
            $getcategories=Category::getcategories();
            if (empty($id)) {
                $title = "Add Category";
                $category = new Category();
                $message = "Category added successfully";
            } else {
                $title = "Edit Category";
                $category = Category::find($id);
                if (!$category) {
                    return redirect()->back()->with('error_message', 'Category not found');
                }
                $message = "Category updated successfully";
            }
    
            if ($request->isMethod('post')) {
                $data = $request->all();
               if($id==""){
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories,url,' . ($category ? $category->id : 'NULL'),
                    // Add other validation rules as needed
                ];
               }else{
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required',
                    // Add other validation rules as needed
                ];
               }
                $customMessages = [
                    'category_name.required' => "Category name is required",
                    'url.required' => "Category URL is required",
                    'url.unique' => "Category URL must be unique",
                    // Add other custom messages for validation
                ];
                $this->validate($request, $rules, $customMessages);
    
                // Handle image upload
                if ($request->hasFile('image')) {
                    $image_temp = $request->file('image');
                    if ($image_temp->isValid()) {
                        $extension = $image_temp->getClientOriginalExtension();
                        $imagename = rand(111, 9999) . '.' . $extension;
                        $image_path = 'admin-assets/front/category/' . $imagename;
                        $img = Image::make($image_temp);
                        $img->save(public_path($image_path));
                        $category->category_image = $imagename;
                    }
                } else {
                    $category->category_image = "";
                }
    
                // Update category fields
                $category->category_name = $data['category_name'];
                $category->parent_id = $data['parent_id'];
                $category->category_discount = $data['category_discount'];
                $category->description = $data['Description'];
                $category->url = $data['url'];
                $category->meta_description = $data['Meta_Description'];
                $category->meta_title = $data['Meta_Title'];
                $category->meta_keyword = $data['Meta_Keywords'];
                $category->status = 1;
    
                // Save category
                $category->save();
                return redirect('admin/categories')->with('success_message', $message);
            }
    
            return view('admin.categories.add-edit-category-page')->with(compact('title', 'getcategories','category'));
        }
        public function deletecategoryimage($id){
            // get category image
            $categoryimage=Category::select('category_image')->where('id',$id)->first();
            // get category image path
            $categoryimage_path='admin-assets/front/category';
            //delete category image from  categorey folder
            if(file_exists($categoryimage_path.$categoryimage->category_image)){
                unlink($categoryimage_path.$categoryimage->category_image);

                // delete category image from category table
                Category::where('id',$id)->update(['category_image'=>""]);
                return redirect()->back()->with('success_message','category image deleted successfully');
            }
            return view('admin.categories.add-edit-category-page');
        }
    
    
}


<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsModel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductsAttributes;
use App\Models\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
class ProductsController extends Controller
{
    //
    public function products(){
        $products=Products::with('category')->get()->toArray();
        // dd($products);
        $productscount=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->count();
        $productsmodule=array();
        if(Auth::guard('admin')->user()->type=='admin'){
            $productsmodule['view_acess']=1;
            $productsmodule['edit_acess']=1;
            $productsmodule['full_acess']=1;
        }else if($productscount==0){
            $message="this feature restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $productsmodule=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->first()->toArray();
        }
        return view('admin.products.products')->with(compact('products','productsmodule'));
    }
    public function updateproductstatus(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Products::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
    public function deleteproduct($id)
    {
        Products::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'deleted successfully');
    }
    public function addedit(Request $request,$id=null){
        if (empty($id)) {
            $title = "Add New Products";
            $product = new Products;
            // $product=array();
            $message = "Product updated successfully";
        } else {
            $message = "Product added successfully";
            $title = "Edit Products";
            $product = Products::with(['images','attributes'])->find($id);
            // dd($product->images);
            if (!$product) {
                return redirect()->back()->with('error_message', 'Product not found');
            }
        }
        if($request->isMethod('post')){
            $data=$request->all();
            // echo '<pre>';print_r($data);die;

           

            // product validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[PL\S\-]+$/u|max:255', 
                'product_code' => 'required', 
                // 'product_code' => 'required|regex:/^[w\-]+$/u|max:30', 
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[PL\S\-]+$/u|max:255', // Example: Allow only letters and spaces for color
                'family_color' => 'required|regex:/^[PL\S\-]+$/u|max:255', // Example: Allow only letters and spaces for family color
                // Add other validation rules as needed
            ];
            

            $customMessages = [
                'category_id.required' => "product  is required",
                'product_name.required' => "product  is required",
                'product_name.regex' => "valid product must be required",
                'product_code.required' => "product code is required",
                // 'product_code.regex' => "valid product code must be required",
                'product_price.required' => "product price is required",
                'product_price.numeric' => "valid product price must be required",
                'product_color.required' => "product color is required",
                'product_color.regex' => "valid product color must be required",
                'family_color.required' => "family color is required",
                'family_color.regex' => "valid family color must be required",
                // Add other custom messages for validation
            ];
            $this->validate($request,$rules,$customMessages);
            // Handle product video if uploaded
        if ($request->hasFile('product_video')) {
            $videoFile = $request->file('product_video');
            if ($videoFile->isValid()) {
                $videoName = rand() . '.' . $videoFile->getClientOriginalExtension();
                $videoPath = "admin-assets/front/VIDEOS";
                $videoFile->move($videoPath, $videoName);
                // Save the video path to the product
                $product->product_video = $videoName;
            }
        }
           
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->family_color = $data['family_color'];
            $product->group_code = $data['group_code'];
            $product->product_price = $data['product_price'];
            $product->product_discount = isset($data['product_discount']) ? $data['product_discount'] : 0;
            $product->product_weight = isset($data['product_weight']) ? $data['product_weight'] : 0;
            $product->description = isset($data['description']) ? $data['description'] :0;
            $product->washcare = $data['washcare'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occassion = $data['occassion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if(!empty($data['is_featured'])){
                $product->is_featured =$data['is_featured'];
            }else{
                $product->is_featured ="No";
            }
            $product->status=1;
            
            
                $product->save();

                if ($id == "") {
                    // Get the last inserted product ID
                    $product_id = DB::getPdo()->lastInsertId();
                } else {
                    $product_id = $id;
                }
                
                // Upload product images
                if ($request->hasFile('product_images')) {

                    
                    $images = $request->file('product_images');
                    foreach ($images as $key => $image) {
                        // Generate temporary image
                        $image_tmp = Image::make($image);
                
                        // Get image extension
                        $extension = $image->getClientOriginalExtension();
                
                        // Generate new image name
                        $imagename = 'product-' . rand(11111, 999999) . '.' . $extension;
                
                        // Define image paths for different sizes
                        $largeimagepath = 'admin-assets/front/products/large/' . $imagename;
                        $mediumimagepath = 'admin-assets/front/products/medium/' . $imagename;
                        $smallimagepath = 'admin-assets/front/products/small/' . $imagename;
                
                        // Resize and save images
                        Image::make($image_tmp)->resize(1040, 1200)->save($largeimagepath);
                        Image::make($image_tmp)->resize(520, 600)->save($mediumimagepath);
                        Image::make($image_tmp)->resize(260, 300)->save($smallimagepath);
                
                        // Insert image into ProductsImage table
                        $productImage = new ProductsImage;
                        $productImage->image = $imagename;
                        $productImage->product_id = $product_id; // Set the product ID
                        $productImage->status = 1;
                        $productImage->save();
                    }
                }

                // sort product images

                if($id!=""){ //video number 59
                    if(isset($data['image'])){
                        foreach($data['image'] as $key=> $image){
                            ProductsImage::where(['product_id'=>$product_id,'image'=>$image])->update(['image_sort'=>$data['image_sort'][$key]]);
                        }
                    }
                }
                foreach($data['sku'] as $key => $value){
                    if(!empty($value)){
                        $countSKU=ProductsAttributes::where('sku',$value)->count();
                        if($countSKU=0){
                            $message="sku  already exists please add another SKU";
                            return redirect()->back()->with('success',$message);
                        }
                        // size already exists check
                        $countSIZE=ProductsAttributes::where(['product_id'=>$product_id,'size'=>$data['size'][$key]])->count();
                        if($countSIZE=0){
                            $message="size  already exists please add another size";
                            return redirect()->back()->with('success',$message);
                        }
                        $attribute=new ProductsAttributes;
                        $attribute->product_id=$product_id;
                        $attribute->sku=$value;
                        $attribute->size=$data['size'][$key];
                        $attribute->price=$data['price'][$key];
                        $attribute->stock=$data['stock'][$key];
                        $attribute->status=1;
                        $attribute->save();
                    }
                }

                // add product attributes
                if(isset($data['attributeId'])){
                    foreach($data['attributeId'] as $key =>$attribute){
                        if(!empty($attribute)){
                            ProductsAttributes::where('id', $data['attributeId'][$key])
                            ->update([
                                'price' => $data['price'][$key],
                                'stock' => $data['stock'][$key]
                            ]);
                                            }
                    }
                }
                
                // edit product attributes
                
                return redirect('admin/products')->with('success_message', $message);
           
            
            
            // try {
            //     $product->save();
            //     return redirect('admin/products')->with('success_message', $message);
            // } catch (\Exception $e) {
            //     // Handle the database saving error appropriately, show error message, log, etc.
            //     return redirect()->back()->with('error_message', 'Product could not be saved: ' . $e->getMessage());
            // }
            
        }
        // get categories and sub categories
        $getcategories=Category::getcategories();

        // get brands
        $getBrands=Brand::where('status',1)->get()->toArray();

        // product filters
        $productsfilter=Products::productsfilter();
        // dd($product['pattern']) ;

        return view('admin.products.add-edit-product-page')->with(compact('title','getcategories','productsfilter','product','getBrands'));
    }
    public function productvideo($id){
        $message='product deleted sucessfully';
        // get product video
        $productvideo=Products::select('product_video')->where('id',$id)->first();
        // get product video path
        $productvideo_path="./admin-assets/front/VIDEOS/";
        // delete product video from folder if exist
        if(file_exists($productvideo_path.$productvideo->product_video)){
            unlink($productvideo_path.$productvideo->product_video);
        }
        // delete product video name from products table
        Products::where('id',$id)->update(['product_video'=>'']);
        return redirect()->back()->with('success_message',$message);
    }

    // delete product image
    public function productimage($id){
        // get product image
        $productImage=ProductsImage::select('image')->where('id',$id)->first();
        // get product image path
        $small_imagepath='admin-assets/front/products/small/';
        $medium_imagepath='admin-assets/front/products/medium/';
        $large_imagepath='admin-assets/front/products/large/';

        // delete product image  if exists in small folder
        if(file($small_imagepath.$productImage->image)){
            unlink($small_imagepath.$productImage->image);
        }
        // delete product image  if exists in medium folder
        if(file($medium_imagepath.$productImage->image)){
            unlink($medium_imagepath.$productImage->image);
        }
        // delete product image  if exists in large folder
        if(file($large_imagepath.$productImage->image)){
            unlink($large_imagepath.$productImage->image);
        }

        // delete product image from products image table
        ProductsImage::where('id',$id)->delete();

        $message='product image has been suessfully deleted'; //video number 58
        return redirect()->back()->with('success_message',$message);

    }

    public function deleteattribute($id)
    {
        ProductsAttributes::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'attribute deleted successfully');
    }

    public function updateattributestatus(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttributes::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }


}





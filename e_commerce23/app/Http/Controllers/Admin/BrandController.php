<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Products;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    //
    public function brands()
    {
        $brands = Brand::get();
        return view('admin.brands.brands')->with(compact('brands'));
    }
    public function updatebrandstatus(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function deletebrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'deleted successfully');
    }
    public function addedit(Request $request, $id = null)
    {
        // ... (other code remains unchanged)
        if (empty($id)) {
            $title = "Add Brands";
            $brand = new Brand;
            // dd($brand);
            $message = "Brand added suessfully!";
        } else {
            $title = "Edit Brands";
            $brand = Brand::find($id);
            if (!$brand) {
                return redirect()->back()->with('error_message', 'Brand not Found');
            }
            $message = "Brand edited suessfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if($id==""){
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required|unique:brands' // Assuming your brand model is named 'Brand'
                    // Add other validation rules as needed
                ];
            }else{
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required' // Assuming your brand model is named 'Brand'
                    // Add other validation rules as needed
                ];
            }

            $customMessage = [
                'brand_name.required' => 'Brand name is required',
                'url.required' => 'URL is required',
                'url.unique' => 'Brand URL must be unique',
                // Add other custom messages for validation as needed
            ];

            $this->validate($request, $rules, $customMessage);

            // Handling image upload for 'brand_image'
            if ($request->hasFile('brand_image')) {
                $image_temp1 = $request->file('brand_image');
                if ($image_temp1->isValid()) {
                    $extension1 = $image_temp1->getClientOriginalExtension();
                    $imagename1 = rand(111, 9999) . '.' . $extension1;
                    $imagepath1 = 'admin-assets/front/brands/brand-image/' . $imagename1;
                    $img1 = Image::make($image_temp1);
                    $img1->save(public_path($imagepath1));
                    $brand->brand_image = $imagename1;
                }
            } else {
                $brand->brand_image = "";
            }

            // Handling image upload for 'brand_logo'
            if ($request->hasFile('brand_logo')) {
                $image_temp2 = $request->file('brand_logo');
                if ($image_temp2->isValid()) {
                    $extension2 = $image_temp2->getClientOriginalExtension();
                    $imagename2 = rand(111, 9999) . '.' . $extension2;
                    $imagepath2 = 'admin-assets/front/brands/brand-logo/' . $imagename2;
                    $img2 = Image::make($image_temp2);
                    $img2->save(public_path($imagepath2));
                    $brand->brand_logo = $imagename2;
                }
            } else {
                $brand->brand_logo = "";
            }

            // remove brand  discount  from all  products  belongs to  specific brand
            if (empty($data['brand_discount'])) {
                $data['brand_discount'] = 0;
                if ($id != "") {
                    $brandproducts = Products::where('brand_id', $id)->get()->toArray();
                    foreach ($brandproducts as $key => $product) {
                        if ($product['discount_type'] == "brand") {
                            Products::where('id', $product['id'])
                                ->where([
                                    'discount_type' => '', // Changed '=' to '=>' for array key-value association
                                    'final_price' => $product['Product_price'] // Changed '=' to '=>' for array key-value association
                                ])->update([
                                    'discount_type' => '', // Set discount_type to empty string
                                    'final_price' => $product['Product_price'] // Set final_price to the original product price
                                ]);
                        }
                    }
                }
            }               

            // Update brand data from the form
            // Update brand data from the form, applying trim() to sanitize the input
            $brand->brand_name = isset($data['brand_name']) ? trim($data['brand_name']) : null;
            $brand->url = isset($data['url']) ? trim($data['url']) : null;
            $brand->brand_discount = isset($data['brand_discount']) ? trim($data['brand_discount']) : null;
            $brand->description = isset($data['description']) ? trim($data['description']) : null;
            $brand->meta_title = isset($data['meta_title']) ? trim($data['meta_title']) : null;
            $brand->meta_description = isset($data['meta_description']) ? trim($data['meta_description']) : null;
            $brand->meta_keywords = isset($data['meta_keywords']) ? trim($data['meta_keywords']) : null;
            $brand->status = 1;

            // $brand->brand_name = $data['brand_name'];
            // $brand->url = $data['url'];
            // $brand->brand_discount = $data['brand_discount'];
            // $brand->description = $data['description'];
            // $brand->meta_title = $data['meta_title'];
            // $brand->meta_description = $data['meta_description']?? null; //By using the null coalescing operator (??), if 'meta_description' is not present in the form data, it will default to null. Adjust this default value as per your application's requirements.
            // $brand->meta_keywords = $data['meta_keywords']?? null;
            // $brand->status = 1;

            // Save the brand instance
            $brand->save();
            return redirect('admin/brands')->with('success_message',$message);

            // ... (other code for redirecting or handling success/failure messages)
        }

        return view('admin.brands.add-edit-brand-page')->with(compact('title', 'message','brand'));
    }
    public function brandimage($id){
        $message='brand image deleted sucessfully';
        // get product video
        $brandimage=Brand::select('brand_video')->where('id',$id)->first();
        // get product video path
        $brandimage_path="./admin-assets/front/brands/brand-image";
        // delete product video from folder if exist
        if(file_exists($brandimage.$brandimage->brand_image)){
            unlink($brandimage_path.$brandimage->brand_image);
        }
        // delete product video name from products table
        Brand::where('id',$id)->update(['brand_image'=>'']);
        return redirect()->back()->with('success_message',$message);
    }
    public function brandlogo($id){
        $message='brand image deleted sucessfully';
        // get product video
        $brandimage=Brand::select('brand_video')->where('id',$id)->first();
        // get product video path
        $brandimage_path="./admin-assets/front/brands/brand-image";
        // delete product video from folder if exist
        if(file_exists($brandimage.$brandimage->brand_image)){
            unlink($brandimage_path.$brandimage->brand_image);
        }
        // delete product video name from products table
        Brand::where('id',$id)->update(['brand_image'=>'']);
        return redirect()->back()->with('success_message',$message);
    }
}

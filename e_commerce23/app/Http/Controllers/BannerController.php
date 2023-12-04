<?php

namespace App\Http\Controllers;

use App\Models\AdminsModel;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class BannerController extends Controller
{
    //
    public function banners(){
        $banners=Banner::get()->toArray();
        // for acess
        $bannerscount=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banners'])->count();
        $bannersmodule=array();
        if(Auth::guard('admin')->user()->type=='admin'){
            $bannersmodule['view_acess']=1;
            $bannersmodule['edit_acess']=1;
            $bannersmodule['full_acess']=1;
        }else if($bannerscount==0){
            $message="this feature restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $bannersmodule=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banners'])->first()->toArray();
        }

        return view('admin.banners.banners')->with(compact('banners','bannersmodule'));
    }
    public function updatebannerstatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }
    public function deletebanner($id){
        $bannerimage=Banner::where('id', $id)->first();
        // get banner image path
        $bannerimage_path='./admin-assets/front/banners/';
        // delete banner image if exist in folder
        if(file_exists($bannerimage_path.$bannerimage->image)){
            unlink($bannerimage_path.$bannerimage->image);
        }
        // ddelete banner image from banners table
        Banner::where('id', $id)->delete();
        return redirect('admin/banners')->with('success_message', 'deleted successfully');
    }
    public function addedit(Request $request ,$id=null){
        if (empty($id)) {
            $title = "Add banner";
            $banner = new Banner();
            $message = "banner added successfully";
        } else {
            $title = "Edit banner";
            $banner = Banner::find($id);
            if (!$banner) {
                return redirect()->back()->with('error_message', 'banner not found');
            }
            $message = "banner updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
           if($id==""){
            $rules = [
                'banner_name' => 'required',
                'url' => 'required|unique:categories,url,' . ($banner ? $banner->id : 'NULL'),
                // Add other validation rules as needed
            ];
           }else{
            $rules = [
                'banner_name' => 'required',
                'link' => 'required',
                // Add other validation rules as needed
            ];
           }
            $customMessages = [
                'banner_name.required' => "banner name is required",
                'link.required' => "banner LINK is required",
                'link.unique' => "banner LINK must be unique",
                // Add other custom messages for validation
            ];
            $this->validate($request, $rules, $customMessages);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image_temp = $request->file('image');
                if ($image_temp->isValid()) {
                    $extension = $image_temp->getClientOriginalExtension();
                    $imagename = rand(111, 9999) . '.' . $extension;
                    $image_path = 'admin-assets/front/banners/' . $imagename;
                    $img = Image::make($image_temp);
                    $img->save(public_path($image_path));
                    $banner->banner_image = $imagename;
                }
            } else {
                $banner->banner_image = "";
            }

            // Update banner fields
            $banner->banner_name = $data['banner_name'];
            $banner->link = $data['link'];
            $banner->alt = $data['alt'];
            $banner->title = $data['title'];
            $banner->sort = $data['sort'];
            $banner->status = 1;

            // Save banner
            $banner->save();
            return redirect('admin/categories')->with('success_message', $message);
            return view('admin.banners.add-edit-banner-page')->with(compact('title', 'banner'));

        }
    }
}

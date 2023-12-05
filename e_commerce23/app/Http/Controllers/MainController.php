<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminsModel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
class MainController extends Controller
{
   
    
    public static function login(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->only('email', 'password');
            
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30',
            ];
            
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];
            
            $validatedData = $request->validate($rules, $customMessages);
            
            if (Auth::guard('admin')->attempt($data)) {
                // check if user click on remember me check box if check email and password store in cookies
                if (isset($data['remember']) && !empty($data['remember'])) {
                    setcookie("email", $data["email"], time() + 3600);
                    setcookie("password", $data["password"], time() + 3600);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->withInput($request->only('email'))->with('error_message', 'Invalid email or password');
            }
        }
        
        return view('admin.login');
    }
    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['CurrentPassword'], Auth::guard('admin')->user()->password)) {
                if ($data['NewPassword'] === $data['ConfirmPassword']) {
                    // Update the new password
                    Admin::where('id', Auth::guard('admin')->user()->id)
                        ->update(['password' => bcrypt($data['NewPassword'])]);
                    return redirect()->back()->with('success_message', 'Your password has been updated successfully');
                } else {
                    return redirect()->back()->with('error_message', 'New password and confirm password do not match');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect');
            }
        }
        return view('update_password');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (isset($data['checkCurrentPassword']) && Hash::check($data['checkCurrentPassword'], Auth::guard('admin')->user()->password)) {
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false, 'error' => 'Current password is incorrect']);
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|alpha|max:255',
                'mobile' => 'required|numeric|min:10',
                'image' => 'image',
            ];
            $customMessage = [
                'name.required' => 'Name is required',
                'name.alpha' => 'Valid name is required',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Valid mobile number is required',
                'image.image' => 'Image is required',
            ];
            $this->validate($request, $rules, $customMessage);

            // Upload admin image
            if ($request->hasFile('image')) {
                $image_temp = $request->file('image');
                if ($image_temp->isValid()) {
                    $extension = $image_temp->getClientOriginalExtension();
                    // Generate a new image name
                    $imagename = rand(111, 99999) . '.' . $extension;
                    $image_path = 'admin-assets/photos/' . $imagename;
                    $img = Image::make($image_temp);
                    $img->save(public_path($image_path));
                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }

            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'image' => $image_path]);

            return redirect()->back()->with('success_message', 'Details updated successfully');
        }
        return view('update_details');
    }
    
    
    public static function dashboard(){
        $categoriesCount=Category::get()->count();
        $productsCount=Products::get()->count();
        $brandsCount=Brand::get()->count();
        $usersCount=User::get()->count();
        return view('admin.dashboard')->with(compact('categoriesCount','productsCount','brandsCount','usersCount'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
     // sub_admins

     public function sub_admins()
     {
         $subadmins = Admin::where('type', 'subadmins')->get();
         return view('admin.subadmins.subadmins')->with(compact('subadmins'));
     }
     public function updatesubadminstatus(Request $request)
     {
         //
         if ($request->ajax()) {
             $data = $request->all();
             if ($data['status'] == 'Active') {
                 $status = 0;
             } else {
                 $status = 1;
             }
             Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
             return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
         }
     }
     public function deletesubadmins($id)
     {
         Admin::where('id', $id)->delete();
         return redirect()->back()->with('success_message', 'deleted successfully');
     }
 
 
     public function addupdatesubadminDetails(Request $request, $id = null)
     {
         if (empty($id)) {
             $title = "Add Subadmin";
             $subadminData = new Admin;
             $message = "Subadmin added successfully";
         } else {
             $title = "Edit Subadmin";
             $subadminData = Admin::find($id);
             $message = "Subadmin updated successfully";
         }
 
         if ($request->isMethod('post')) {
             $data = $request->all();
             if (empty($id)) {
                 $subadmincount = Admin::where('email', $data['email'])->count();
                 if ($subadmincount > 0) {
                     return redirect()->back()->with('error_message', 'Subadmin already exists!');
                 }
             }
 
             $rules = [
                 'name' => 'required',
                 'mobile' => 'required|numeric',
                 'image' => 'image',
             ];
             $customMessage = [
                 'name.required' => 'Name is required',
                 'mobile.required' => 'Valid mobile number is required',
                 'mobile.numeric' => 'Valid mobile number is required',
                 'image.image' => 'Valid image is required',
             ];
             $this->validate($request, $rules, $customMessage);
 
             if ($request->hasFile('image')) {
                 $image_temp = $request->file('image');
                 if ($image_temp->isValid()) {
                     $extension = $image_temp->getClientOriginalExtension();
                     $imagename = rand(111, 99999) . '.' . $extension;
                     $image_path = 'admin-assets/photos/' . $imagename;
                     $img = Image::make($image_temp);
                     $img->save(public_path($image_path));
                 }
             } else if (!empty($data['current_image'])) {
                 $image_path = $data['current_image'];
             } else {
                 $image_path = "";
             }
             // dd($subadminData);
             // echo "<pre>";
             // print_r($subadminData);
 
             $subadminData->image = $image_path;
             $subadminData->name = $data['name'];
             $subadminData->mobile = $data['mobile'];
             if (empty($id)) {
                 $subadminData->email = $data['email'];
                 $subadminData->type = 'subadmins';
             }
             if (!empty($data['password'])) {
                 $subadminData->password = bcrypt($data['password']);
             }
             // dd($subadminData);
             // echo "<pre>";
             // print_r($subadminData);
             $subadminData->status=1;
             $subadminData->save();
 
             return redirect('admin/sub-admins')->with('success_message', $message);
         }
 
         return view('admin.subadmins.add-edit-subadmins-page', compact('title', 'subadminData'));
     }
 
 
     public function UpdateRole($id,Request $request){
         
         if($request->isMethod('post')){
             $data=$request->all();
             // echo "<pre>";
             // print_r($data);
             // die;
             AdminsModel::where('id',$id)->delete();
 
             // add new roles for subadmins for dynamically
             foreach($data as $key=>$value){
                 if(isset($value['view'])){
                     $view=$value['view'];
                 }else{
                     $view=0;
                 }
                 if(isset($value['edit'])){
                     $edit=$value['edit'];
                 }else{
                     $edit=0;
                 }
                 if(isset($value['full'])){
                     $full=$value['full'];
                 }else{
                     $full=0;
                 }
                //  AdminsModel::where('subadmin_id',$id)->insert(['subadmin_id'=>$id,'module'=>$key,'view_access'=>$view,'edit_access'=>$edit,'full_access'=>$full]);
             }
 
         
             $role=new AdminsModel;
             $role->subadmin_id=$id;
             $role->module=$key;
             $role->edit_acess=$edit;
             $role->view_acess=$view;
             $role->full_acess=$full;
             $role->save();
 
             
             $message='subadmin roles updated successfully';
             return redirect()->back()->with('success_message',$message);
 
         }
         $subadminroles=AdminsModel::where('subadmin_id',$id)->get()->toArray();
         $suadmindetails = Admin::where('id', $id)->first()->toArray();
         $title = "Update " . $suadmindetails['name'] . " Subadmin Roles/Permissions";
 
         
 
         return view('admin.subadmins.update_roles')->with(compact('title','id','subadminroles'));
     }
}

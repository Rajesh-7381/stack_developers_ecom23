<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        return view('admin.dashboard');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}

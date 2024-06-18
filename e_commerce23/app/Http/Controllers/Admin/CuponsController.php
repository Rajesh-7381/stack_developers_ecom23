<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsModel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Cupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CuponsController extends Controller
{
    //
    public function cupons(){
        $cupons=Cupon::get()->toArray();

        $cuponscount=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cupons'])->count();
        $cuponsmodule=array();
        if(Auth::guard('admin')->user()->type=='admin'){
            $cuponsmodule['view_acess']=1;
            $cuponsmodule['edit_acess']=1;
            $cuponsmodule['full_acess']=1;
        }else if($cuponscount==0){
            $message="this feature restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $cuponsmodule=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
        }
        return view('admin.cupons.cupons')->with(compact('cupons'));
    }
    public function updatecuponstatus(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Cupon::where('id', $data['cuppon_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'cuppon_id' => $data['cuppon_id']]);
        }
    }
    public function deletecupons($id)
    {
        Cupon::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'deleted successfully');
    }

    public function addEditcupon(Request $request, $id = null)
    {
        if ($id == null) {
            $cupon = new Cupon();
            $title = "Add Cupon";
            $message = "Cupon added successfully!";
        } else {
            $cupon = Cupon::find($id);
            $title = "Edit Cupon";
            $message = "Cupon edited successfully!";
        }
    
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
    
            // Validation Rules
            $rules = [
                'categories' => 'required',
                'brands' => 'required',
                'cupon_option' => 'required',
                'cupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'numeric',
                'expiary_date' => 'required',
            ];
    
            $customMessage = [
                'categories.required' => "Category is required",
                'brands.required' => "Brand is required",
                'cupon_option.required' => "please choose one",
                'cupon_type.required' => "please choose one",
                'amount_type.required' => "please choose one",
                'amount.numeric' => "please entered amount",
                'expiary_date.required' => "please entered amount",
            ];
    
            // Validate the request
            $this->validate($request, $rules, $customMessage);

            // convert categories array to string
            if(isset($data['categories'])){
                $categories=implode(',',$data['categories']);
            }else{
                $categories="";
            }


            // convert brands array to string
            if(isset($data['brands'])){
                $brands=implode(',',$data['brands']);
            }else{
                $brands="";
            }

            // convert users array to string
            // if(isset($data['users'])){
            //     $users=implode(',',$data['users']);
            // }else{
            //     $users="";
            // }

            if($data['cupon_option']=='automatic'){
                $cupon_code=Str::random(8);
            }else{
                $cupon_code=$data['cupon_option'];
            }
            
    
            // Insert or Update data
            $cupon->categories = $categories;
            $cupon->brands = $brands;
            // $cupon->users = $users;
            $cupon->cupon_option = $data['cupon_option'];
            $cupon->cupon_code = $data['cupon_code'];
            $cupon->cupon_type = $data['cupon_type'];
            $cupon->amount_type = $data['amount_type'];
            $cupon->amount = $data['amount'];
            $cupon->expiary_date = $data['expiary_date'];
            $cupon->status = 1;
            $cupon->save();
    
            return redirect('admin/cupons')->with('success_message', $message);
        }
    
        // Get categories and subcategories
        $getcategories = Category::getcategories();
    
        // Get brands
        $getBrands = Brand::where('status', 1)->get()->toArray();
        // get user emails
        $getusers=User::select('email')->where('status',1)->get()->toArray();
    
        return view('admin.cupons.add-edit-cuppon')->with(compact('title', 'cupon', 'getcategories', 'getBrands','getusers'));
    }
    
}

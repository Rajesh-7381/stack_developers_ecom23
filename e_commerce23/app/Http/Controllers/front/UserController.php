<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    //
    public function userRegister(Request $request){
        if($request->ajax()){
            $validator=Validator::make($request->all(),[
                'name' => 'required|string|max:30',
                'mobile' => 'required|numeric|digits:10',
                'email' => 'required|email|max:250|unique:users,email',
                'password' => 'required|string|min:6',
            ],
            [
                'email'=>'please enter valid email '
            ]);
            if ($validator->passes()) {
                $data = $request->all();
                $user = new User();
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                // activate user only when user confirms his email account
                
                    $email=$data['email'];
                    $messagedata=['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                    Mail::send('emails.confirmation',$messagedata,function($message) use ($email){
                        $message->to($email)->subject('welcome to our ....web...');
                    });
                    $redirectUrl = url('user/register');
                    return response()->json(['status' => true, 'type' => 'success', 'redirecturl' => $redirectUrl,'message'=>'please confirm your mail to activate your account']);
                
            
            } else {
                return response()->json(['status' => false, 'type' => 'validation', 'errors' => $validator->messages()]);
            }
            
            
        }
        return view('front.users.register');
        
    }
    // use Illuminate\Support\Facades\Route;

    // // ...
    
    public function confirmAccount($code)
    {
        $email = base64_decode($code);
        $userAccount = User::where('email', $email)->count();
    
        if ($userAccount > 0) {
            $userDetails = User::where('email', $email)->first();
    
            if ($userDetails->status == 1) {
                // Redirect to the user login page using the 'user.login' named route
                return redirect()->route('login')->with('error_message', 'Your account is already activated. You can login now.');
            } else {
                User::where('email', $email)->update(['status' => 1]);
    
                // Send welcome mail
                $messageData = ['email' => $userDetails->email, 'name' => $userDetails->name, 'mobile' => $userDetails->mobile];
                Mail::send('emails.register', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to our web...');
                });
    
                // Redirect to the user login page using the 'user.login' named route
                return redirect()->route('login')->with('success_message', 'Your account has been activated. You can login now.');
            }
        } else {
            abort(404);
        }
    }
    
    
    public function userlogin(Request $request){
        if($request->ajax()){
            $data=$request->all();
            // echo "<pre>";print_r($data);die;

            $validator=Validator::make($request->all(),[
                
                'email' => 'required|email|max:250|exists:users',
                'password' => 'required|min:6',
            ],
            [
                'email.exists'=>'this email id not exists '
            ]);
            if($validator->passes()){
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    if(!empty($data['remember-me'])){
                        setcookie('user-email',$data['email'],time()+3600);
                        setcookie('user-password',$data['password'],time()+3600);
                    }else{
                        setcookie('user-email');
                        setcookie('user-password');
                    }
                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['status' => false, 'type' => 'inactive', 'message' => 'your account is not activated yet!']);

                    }
               
                    $redirectUrl=url('cart');
                    return response()->json(['status' => false, 'type' => 'success', 'redirectUrl' =>$redirectUrl]);

    
                // Redirect to the user login page using the 'user.login' named route
                return redirect()->route('login')->with('success_message', 'Your account has been activated. You can login now.');

                }else{
                    return response()->json(['status' => false, 'type' => 'incorrect', 'errors' =>'you have entered wrong email or password!']);

                }
            }else{
                return response()->json(['status' => false, 'type' => 'error', 'errors' => $validator->messages()]);

            }

        }
           
        return view('front.users.login');

    
    }
    public function logout(){
        Auth::logout();
        return redirect('user/login');

    }
    public function forgotpassword(Request $request){
        if($request->ajax()){
            $data=$request->all();
            // echo "<pre>";print_r($data);die;
            $validator=Validator::make($request->all(),[
                
                'email' => 'required|email|max:250|exists:users',
                
            ],
            [
                'email.exists'=>'this email id not exists '
            ]);
            if($validator->passes()){
                $email=$data['email'];
                $messagedata=['email'=>$data['email'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.reset_password',$messagedata,function($message) use ($email){
                    $message->to($email)->subject(' Reset your password!...');
                });
                // Redirect to the user login page using the 'user.login' named route
                return   response()->json(['type'=>'success','message'=>'reste password sent your registered email!']);
            }else{
                return response()->json(['status' => false, 'type' => 'error', 'errors' => $validator->messages()]);

            }

        }else{
            
        }
        return view('front.users.forgot_password');
    }
    public function resetpassword(Request $request,$code=null){
       if($request->ajax()){
        $data=$request->all();
         echo "<pre>";print_r($data);die;
         $email=base64_encode($code);
         $usercount=User::where('email',$email)->count();
         if($usercount > 0){
            // update new password
            User::where('email',$email)->update(['password'=>bcrypt($data['password'])]);
            // send confirmation mail to user
            $messagedata=['email'=>$data['email']];
                Mail::send('emails.new_password_confirmation',$messagedata,function($message) use ($email){
                    $message->to($email)->subject(' new   password send your email address!...');
                });
                return   response()->json(['type'=>'success','message'=>'new password sent your registered email  and yoc can login now!']);

         }

        
       }else{
        return view('front.users.reset_password')->with(compact('code'));
       }
    }
    public function account(Request $request){
        if($request->ajax()){
            $data=$request->all();
            // echo "<pre>";print_r($data);die;
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'city' => 'required|string|max:150',
                'state' => 'required|string|max:150',
                'country' => 'required|string|max:150', // Update to match your actual field name
                'address' => 'required|string|max:150',
                'pincode' => 'required|numeric|max:999999|min:100000', // Assuming you want a 6-digit pincode
                'mobile' => 'required|numeric|max:9999999999|min:1000000000', // Assuming you want a 10-digit mobile number
            ]);
            
            if($validator->passes()){
                User::where('id',Auth::user()->id)->update(['name'=>$data['name'],'city'=>$data['city'],'state'=>$data['state'],'address'=>$data['address'],'pincode'=>$data['pincode'],'mobile'=>$data['mobile'],'country'=>$data['country']]);
                return   response()->json(['status'=>true,'type'=>'success','message'=>'updated your deatails successfully!']);
            }else{
                return response()->json(['status' => false, 'type' => 'validation', 'errors' => $validator->messages()]);
            }

        }else{
            $countries=Country::where('status',1)->get()->toArray();
            return view('front.users.account')->with(compact('countries'));
        }
        // return view('front.users.account');
    }
}

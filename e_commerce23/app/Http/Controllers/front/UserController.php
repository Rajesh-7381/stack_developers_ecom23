<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
                return redirect()->route('user.login')->with('error_message', 'Your account is already activated. You can login now.');
            } else {
                User::where('email', $email)->update(['status' => 1]);
    
                // Send welcome mail
                $messageData = ['email' => $userDetails->email, 'name' => $userDetails->name, 'mobile' => $userDetails->mobile];
                Mail::send('emails.register', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to our web...');
                });
    
                // Redirect to the user login page using the 'user.login' named route
                return redirect()->route('user.login')->with('success_message', 'Your account has been activated. You can login now.');
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
                return redirect()->route('user.login')->with('success_message', 'Your account has been activated. You can login now.');

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
    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use Auth;
use Hash;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules= [
            'email'=>'required|email|max:255',
            'password'=>'required'
            ];
            $customMessage = [
            'email.required'=>'Email is Required',
            'email.emailk'=>'Valid Email is Required',
            'password.required' =>'Password is Required'
            ];


            $request->validate($rules,$customMessage);

            // cookies set successfully
            if(!empty($_POST['remember'])){
                setcookie("email",$_POST['email'],time()+3600);
                setcookie("password",$_POST['password'],time()+3600);
            }else{
                setcookie("email","");
                setcookie("password","");
            }



            //echo "<pre>"; print_r($data); die;
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message',"Invalid Creadentials");
            }
        }
        return view('admin.login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login') ;
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
        $data = $request->input();
        //echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            if($data['new_pwd']==$data['confirm_pwd']){
                Admin::where('email',Auth::guard('admin')->user()->email)->update(['password'=>bcrypt($data['new_pwd'])]);
                return redirect()->back()->with('success_message',"Password Has Been update successfully!");

            }else{
                return redirect()->back()->with('error_message',"New Password and Confirm Pasword not match!");

                }
        }else{
            return redirect()->back()->with('error_message',"Your Current password is Incorrect!");
        }
        }
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data);die;
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }


}



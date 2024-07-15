<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;


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

    public function updatePassword(){
        return view('admin.update_password');
    }
}

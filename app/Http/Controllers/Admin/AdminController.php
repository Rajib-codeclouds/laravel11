<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use Auth;
use Hash;
use Image;
use Session;


class AdminController extends Controller
{
    public function dashboard(){
     Session::put('page','dashboard');
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
            'email.email'=>'Valid Email is Required',
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
        Session::put('page','update-password');
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
    public function updateAdminDetails(Request $request){
        Session::put('page','update-admin-details');
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules= [
            'name'=>'required|alpha',
            'mobile'=>'required|numeric'
            ];
            $customMessage = [
            'name.required'=>'Name is Required',
            'name.alpha'=>'Valid Name is Required',
            'mobile.required'=>'Mobile is Required',
            'mobile.numeric' =>'Valid Mobile Number is Required'
            ];
            $request->validate($rules,$customMessage);

            if($request->hasFile('image')){
                $image_tmp  = $request->file('image');
                if($image_tmp->isValid()){
                    $extension  = $image_tmp->getClientOriginalExtension();
                    // generate new image
                    $fileName = rand(111,99999).'.'.$extension;
                    $banner_path = 'admin/images/photos/'.$fileName;
                    Image::make($image_tmp)->save($banner_path);
                }
            }else if(!empty($data['current_image'])){
                    $fileName = $data['current_image'];
            }else{
                $fileName = '';
            }

            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$fileName]);
            return redirect()->back()->with('success_message',"details Has Been updated successfully!");
        }
        return view('admin.update_admin_details');
    }


}



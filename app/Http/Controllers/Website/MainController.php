<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    
    public function index (){
        return view('website.index');
    }

    public function home()
    {
        return view('website.client_home');
    }

    public function showLoginForm(){
        return view('website.login');
    }

    public function login(Request $request){
        
        $rule = [
            'phone'=>'required',
            'password'=>'required',
        ];
        $msg = [
            'phone.required'=>'phone is required',
            'password.required'=>'password filed is required',
        ];
        $this->validate($request,$rule,$msg);
       
        if (Auth::guard('client')->attempt(['phone'=> $request->phone ,'password'=>$request->password ],$request->remember)){
            
            return redirect()->intended(route('client_home'));
        }

        return redirect()->back()->withInput($request->only('phone','remember'));
    }

    public function showRegisterForm(){
        return view('website.register');
    }

    public function register(Request $request){
        dd("here");
    }
}

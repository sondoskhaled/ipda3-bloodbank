<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Client;
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
       
        if (Auth::guard('client')->attempt(['phone'=> $request->phone ,'password'=>$request->password ,'is_active'=>1 ],$request->remember)){
            
            return redirect()->intended(route('client_home'));
        }
        flash()->error('information is wrong or account is not active');
        return redirect()->back()->withInput($request->only('phone','remember'));
    }

    public function showRegisterForm(){
        return view('website.register');
    }

    public function register(Request $request){
        $rule = [
            'phone' => 'required|unique:clients',
            'city_id'=> 'required|exists:cities,id',
            'name' => 'required',
            'email' => 'required|unique:clients',
            'password'=>'required',
            'last_donation_date' => 'required|date|after:d_o_b',
            'd_o_b' => 'required|date|before:tomorrow',
            'blood_type_id' => 'required|exists:blood_types,id'
        ];
        
        $this->validate($request,$rule);
        
        $request->merge(['password'=> bcrypt($request->password)]);
        $client=Client::create($request->all());
        $client->api_token=str_random(60);
        $client->save();
        flash()->success('account created successfully');
           return view('website.login');
    }

    public function about(){
        return view('website.about');
        
    }

    public function post($id){
        $record= Post::findOrFail($id);
        return view('website.post',compact('record'));  
    }

    public function donation($id){
        $record= DonationRequest::findOrFail($id);
        return view('website.donation',compact('record'));
    }

    public function donations(){
        $record= DonationRequest::orderBy('id','DESC')->paginate(4);
        return view('website.donations',compact('record'));
    }

    public function contactUsShow(){
        return view('website.contact_us');
    }

    public function contactUsSave(Request $request){
        
           $contacts = Contact::create($request->all());
           flash()->success('your message sent successfully');
           return view('website.contact_us');
      
    }

    public function profileShow(){
        $model= Client::findOrFail(Auth::user()->id);
       // dd($model);
        return view('website.profile',compact('model'));
    }

    public function profileEdit(Request $request,$id){
        
        
        $rule = [
            'phone' => 'required|unique:clients,id,'.$id,
            'city_id'=> 'required|exists:cities,id',
            'name' => 'required',
            'email' => 'required|unique:clients,id,'.$id,
            'last_donation_date' => 'required|date|after:d_o_b',
            'd_o_b' => 'required|date|before:tomorrow',
            'blood_type_id' => 'required|exists:blood_types,id'
        ];
       
        $this->validate($request,$rule);
        // $model= Client::findOrFail($id);
         
        Auth::user()->update($request->all());
        flash()->success('profile edited successfully');
        return redirect(route('profile'));
    }


    public function requestShow(){
        return view('website.request');
    }

    public function requestSave(Request $request,$id){
        
        $request->merge(['client_id'=> $id]);
       // dd($request->all());
        $donation = DonationRequest::create($request->all());
        flash()->success('request created successfully');
        return view('website.request');
      
    }

    public function filter(Request $request){
        
        if(($request->city_id != null) && ($request->blood_type_id != null)){
            $record=DonationRequest::where('city_id',$request->city_id)
            ->where('blood_type_id',$request->blood_type_id)->orderBy('id','DESC')->paginate(4);
            return view('website.donations',compact('record')); 
        }
        elseif(($request->city_id != null)){
            $record=DonationRequest::where('city_id',$request->city_id)->orderBy('id','DESC')->paginate(4);
            return view('website.donations',compact('record')); 
        }
        elseif(($request->blood_type_id != null)){
            $record=DonationRequest::where('blood_type_id',$request->blood_type_id)->orderBy('id','DESC')->paginate(4);
            return view('website.donations',compact('record')); 
        }
        else{
            $record=DonationRequest::orderBy('id','DESC')->paginate(4);
            return view('website.donations',compact('record'));
        }
        
    }

    public function toggleFav(Request $request){
        $toggle=Auth::user()->posts()->toggle($request->post_id);
        return apiResponsejson(1,'success',$toggle);
    }
}

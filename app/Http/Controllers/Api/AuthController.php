<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Mail\ResetPassword;
use App\Models\Token;
use Hash;


class AuthController extends Controller
{
    public function registerToken(Request $request){
        $validator = validator()->make($request->all(),[
            'token' => 'required',
            'type'=> 'required|in:android,ios'
        ]);

        if($validator->fails())
        {
            return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
        }

        Token::where('token',$request->token)->delete();
        $client=Client::where('api_token',$request->api_token)->first();
      
      if($client)
        {
            $client->tokens()->create($request->all());
            return apiResponsejson(1,"تم الاضافه بنجاح");
          }else{
            return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
          }

    }

    public function removeToken(Request $request){
        $validator = validator()->make($request->all(),[
            'token' => 'required'
        ]);

        if($validator->fails())
        {
            return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
        }

        Token::where('token',$request->token)->delete();
        
         
            return apiResponsejson(1,"تم الحذف بنجاح");
         

    }


   public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'phone' => 'required|unique:clients',
            'city_id'=> 'required|exists:cities,id',
            'name' => 'required',
            'email' => 'required|unique:clients',
            'password'=>'required',
            'last_donation_date' => 'required|date|after:d_o_b',
            'd_o_b' => 'required|date|before:tomorrow',
            'blood_type_id' => 'required|exists:blood_types,id'
        ]);

        if($validator->fails())
        {
            return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $request->merge(['password'=> bcrypt($request->password)]);
        $client=Client::create($request->all());
        $client->api_token=str_random(60);
        $client->save();
        return apiResponsejson(1,"تم الإضافة بنجاح",[
            'api_token' => $client->api_token,
            'client' => $client
        ]);
   }

   public function login (Request $request){
            $validator = validator()->make($request->all(),[
                'phone' => 'required',
                'password'=>'required'
            ]);

            if($validator->fails())
            {
                return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
            }

        // $auth= auth()->guard('api')->validate($request->all());
            $client=Client::where('phone',$request->phone)->first();
            if($client){
                if(Hash::check($request->password,$client->password)){
                    return apiResponsejson(1,"تم تسجيل الدخول بنجاح",[
                        'api_token' => $client->api_token,
                        'client' => $client
                    ]);
                }else{
                    return apiResponsejson(0,"البيانات غير صحيحه");
        
                }
            }
            else{
                return apiResponsejson(0,"البيانات غير صحيحه");
            }
   
   }

 public function resetPassword(Request $request){
    $validator = validator()->make($request->all(),[
        'phone' => 'required|exists:clients,phone',
        
    ]);

    if($validator->fails())
    {
        return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
    }

    $client=Client::where('phone',$request->phone)->first();
    if($client){
        $pin_code=rand(1111,9999);
       $client->pin_code=$pin_code;
        if($client->save()){


            //send Email
            \Mail::to($client->email)
            ->bcc("cleanegnti@gmail.com")
            ->send(new ResetPassword($client));
          

            return apiResponsejson(1,"بالرجاء فحص البريد الألكتروني الخاص بك",[
                'pin_code' => $pin_code,
                
            ]);
        }
        else{
            return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
        }

        
    }
    else{
        return apiResponsejson(0,"الهاتف الذي تم ادخاله غير صحيح");
    }


   }

   public function newPassword (Request $request){
        $validator = validator()->make($request->all(),[
            'phone' => 'required|exists:clients,phone',
            'password' => 'required',
            'pin_code' => 'required',
            
        ]);

        if($validator->fails())
        {
            return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
        }

        $client=Client::where('phone',$request->phone)->first();

        if($client->pin_code == $request->pin_code){
            $client->password = bcrypt($request->password);
            $client->pin_code=null;

            if($client->save()){

              
    
                return apiResponsejson(1,"تم تغيير كلمة المرور بنجاح");
            }
            else{
                return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
            }

        }
        else{
            return apiResponsejson(0,"الكود الذي تم ادخاله غير صحيح");
        }


   }

   public function editProfile(Request $request){
    $client=Client::where('api_token',$request->api_token)->first();

        if($client){
            if($request->has('name') || $request->has('city_id') || $request->has('phone') || $request->has('email') ||
            $request->has('password') || $request->has('last_donation_date') || $request->has('d_o_b') || $request->has('blood_type_id') ){
               
                if ($request->has('name')) {
                    $validator = validator()->make($request->all(),[
                       'name' => 'required'
                    ]);
            
                    if($validator->fails())
                    {
                        return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                    }

                    $client->name=$request->name;
    
                }
    
                if ($request->has('email')) {
                    $validator = validator()->make($request->all(),[
                        'email' => 'required|unique:clients'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->email=$request->email;
    
                }
    
                if ($request->has('phone')) {

                    $validator = validator()->make($request->all(),[
                        'phone' => 'required|unique:clients'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->phone=$request->phone;
    
                }
    
                if ($request->has('last_donation_date')) {

                    $validator = validator()->make($request->all(),[
                        'last_donation_date' => 'required|date|after:d_o_b'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->last_donation_date=$request->last_donation_date;
    
                }
    
                if ($request->has('d_o_b')) {
                    $validator = validator()->make($request->all(),[
                        'd_o_b' => 'required|date|before:tomorrow'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->d_o_b=$request->d_o_b;
    
                }
    
                if ($request->has('blood_type_id')) {
                    $validator = validator()->make($request->all(),[
                        'blood_type_id' => 'required|exists:blood_types,id'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->blood_type_id=$request->blood_type_id;
    
                }
    
                if ($request->has('password')) {
                    $validator = validator()->make($request->all(),[
                        'password' => 'required'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->password=$request->password;
    
                }
    
                if ($request->has('city_id')) {
                    $validator = validator()->make($request->all(),[
                        'city_id'=> 'required|exists:cities,id'
                     ]);
             
                     if($validator->fails())
                     {
                         return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
                     }

                    $client->city_id=$request->city_id;
    
                }

                if($client->save()){
                    return apiResponsejson(1,"تم حفظ التغيير بنجاح",[
                        'client' => $client
                    ]);
                 }
                 else{
                    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
                 }
    
            }
            
            else{

                return apiResponsejson(1,"بيانات العميل",[
                    'client' => $client
                ]);
            }
            
            
        }
        else{
            return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
        }
   }
}

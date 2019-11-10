<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Token;

class MainController extends Controller
{

  public function UnReadNotificationCount(Request $request){
    $client=Client::where('api_token',$request->api_token)->first();

    $count=$client->notificationsMorph()->where('is_read',0)->count();
    return apiResponsejson(1,'success',$count);
  }

  public function governorates (){

        $governorates = Governorate::all();
        return apiResponsejson(1,'success',$governorates);
 }

 public function bloodTypes(){
    
   $bloodTypes = BloodType::all();
   return apiResponsejson(1,'success',$bloodTypes);
 }

 public function settings(){
   $settings = Setting::all();
   return apiResponsejson(1,'success',$settings);
 }

 public function contacts(){
   $contacts = Contact::all();
   return apiResponsejson(1,'success',$contacts);
 }

 public function categories(){
   $categories = Category::all();
   return apiResponsejson(1,'success',$categories);
 }
 
 public function getDonationRequests(Request $request){
  
  $DonationRequest = DonationRequest::where(function($query) use($request){
    //search by blood type and city 
     if($request->has(['blood_type_id','city_id']) ){
        $query->where([['blood_type_id',$request->blood_type_id],['city_id',$request->city_id]]);
      }
      //search by city
     if($request->has('city_id') ){
      $query->where('city_id',$request->city_id);
      }
      // search by blood type
      if($request->has('blood_type_id') ){
        $query->where('blood_type_id',$request->blood_type_id);
      }
      })->with('bloodType','city')->paginate(10);

     return apiResponsejson(1,'success',$DonationRequest);

 }

 public function createDonationRequest(Request $request){
        $validator = validator()->make($request->all(),[
          'patient_name' => 'required',
          'patient_phone' => 'required',
          'patient_age' => 'required',
          'hospital_name' => 'required',
          'hospital_address' => 'required',
          'city_id'=> 'required|exists:cities,id',
          'lat' => 'required',
          'lng' => 'required',
          'bags_num'=>'required',
          'details' => 'required',
          'client_id' => 'required|exists:clients,id',
          'blood_type_id' => 'required|exists:blood_types,id'
      ]);

      if($validator->fails())
      {
          return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
      }

    $DonationRequest=DonationRequest::create($request->all());

    //find clients suitable for this donation request

    $clientsId=$DonationRequest->city->governorate->clientsMorph()->whereHas('bloodTypesMorph',function ($q) use($request){
      $q->where('blood_types.id',$request->blood_type_id);
    })->pluck('clients.id')->toArray();

    
    if(count($clientsId)){
      //creat notification in database
      $blood_type=BloodType::where('id',$request->blood_type_id)->first();
      $blood_type_name=$blood_type->name;
      $notification=$DonationRequest->notification()->create([
          'title'=> 'يوجد حالة تبرع ',
          'content'=> $blood_type_name . 'يحتاج تبرع لفصيلة'
      ]);

      //attach notification to client
      $notification->clientsMorph()->attach($clientsId);

      //get tokens
      $tokens=Token::whereIn('client_id',$clientsId)->where('token','!=',null)->pluck('token')->toArray();
     
       if(count($tokens)){
      

        $title=$notification->title;
         $content=$notification->content;
        $data=[
          
          'donation_request_id' =>$DonationRequest->id,
        ];

     //dd($tokens);
      $send=notifyByFirebase($title,$content,$tokens,$data);
      


       }
    }

    return apiResponsejson(1,'تم إضافة الحالة بنجاح',$send);


 }

 public function posts (Request $request){

   //$posts = Post::with('category')->paginate(10);

   $posts = Post::where(function($query) use($request){

      if($request->has('category_id') ){
         $query->where('category_id',$request->category_id);
      }
    })->with('category')->paginate(10);

   return apiResponsejson(1,'success',$posts);
}

public function post (Request $request){
  if($request->has('post_id') ){
    $post = Post::where('id',$request->post_id)->with('category')->get();

    return apiResponsejson(1,'success',$post);
   }
  else{
    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");

  }

}

public function listOfFav (Request $request){
  $client=Client::where('api_token',$request->api_token)->first();
  if($client)
    {
      $fav=$client->posts()->pluck('posts.id');
      
      return apiResponsejson(1,"list of favourites",[
        'favourites' => $fav
        
      ]);
  }else{
    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
  }
}

public function toggleFav (Request $request){
  $client=Client::where('api_token',$request->api_token)->first();
  if($client)
    {

          $validator = validator()->make($request->all(),[
            'fav_post_id'=> 'exists:posts,id',
            
           ]);

        if($validator->fails())
        {
            return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
        }

      $client->posts()->toggle($request->fav_post_id);


      $fav=$client->posts()->pluck('posts.id');
      
      return apiResponsejson(1,"toggel favourate done successfully ,list of favourites",[
        'favourites' => $fav
        
      ]);
  }else{
    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
  }
}

 public function getNotificationSetting(Request $request){
  $client=Client::where('api_token',$request->api_token)->first();
  
  if($client)
    {
      $governorates=$client->governoratesMorph()->pluck('governorates.id');
      $bloodTypes=$client->bloodTypesMorph()->pluck('blood_types.id');
    
      return apiResponsejson(1,"notification setting",[
        'governorates' => $governorates,
        'blood_types' => $bloodTypes
        
      ]);
  }else{
    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
  }
  

 }


 public function updateNotificationSetting(Request $request){
  $client=Client::where('api_token',$request->api_token)->first();
  
  if($client)
    {
      $validator = validator()->make($request->all(),[
        'governorates'=> 'exists:governorates,id',
        'blood_types' => 'exists:blood_types,id'
    ]);

    if($validator->fails())
    {
        return apiResponsejson(0,$validator->errors()->first(),$validator->errors());
    }

      $client->governoratesMorph()->sync($request->governorates);
      $client->bloodTypesMorph()->sync($request->blood_types);  


      $gov=$client->governoratesMorph()->pluck('governorates.id');
      $bloodTypes=$client->bloodTypesMorph()->pluck('blood_types.id');
    
      return apiResponsejson(1,"notification setting updated successfully",[
        'governorates' => $gov,
        'blood_types' => $bloodTypes
        
      ]);
  }else{
    return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
  }
  

 }

 public function notificationList (Request $request){

      $client=Client::where('api_token',$request->api_token)->first();
      
      if($client)
        {
          $notifications=$client->notificationsMorph()->pluck('notifications.id');
          
        
          return apiResponsejson(1,"notification list",[
            'notifications' => $notifications
            
          ]);
      }else{
        return apiResponsejson(0,"حدث خطأ الرجاء المحاولة في وقت لاحق");
      }
 }

 public function cities (Request $request){

    $cities = City::where(function($query) use($request){

      if($request->has('governorate_id') ){
         $query->where('governorate_id',$request->governorate_id);
      }
    })->with('governorate')->get();
    return apiResponsejson(1,'success',$cities);
}
}

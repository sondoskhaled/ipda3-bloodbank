<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1' , 'namespace' => 'Api'],function(){
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::get('categories','MainController@categories');
    Route::get('settings','MainController@settings');
    Route::get('contacts','MainController@contacts');
    Route::get('blood_types','MainController@bloodTypes');
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('reset_password','AuthController@resetPassword');
    Route::post('new_password','AuthController@newPassword');

    Route::group(['middleware'=>'auth:api'],function(){

        Route::get('posts','MainController@posts');
        Route::get('post','MainController@post');
        Route::post('edit_profile','AuthController@editProfile');
        Route::get('get_notification_setting','MainController@getNotificationSetting');
        Route::post('update_notification_setting','MainController@updateNotificationSetting');
        Route::get('list_of_fav','MainController@listOfFav');
        Route::post('toggel_Fav','MainController@toggleFav');
        Route::get('get_donation_requests','MainController@getDonationRequests');
        Route::post('create_donation_request','MainController@createDonationRequest');
        Route::get('notification_list','MainController@notificationList');
        Route::get('unread_notification_count','MainController@UnReadNotificationCount');
        Route::post('register_token','AuthController@registerToken');
        Route::post('remove_token','AuthController@removeToken');
    });


});


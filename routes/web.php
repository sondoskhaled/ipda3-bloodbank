<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'client'],function(){

    Route::get('index', function () {
        return view('website.index');
    });
 });

Route::group(['middleware'=>['auth'] ,'prefix' => 'client'],function(){

Route::get('/home','HomeController@index')->name('client_home');
    });


Route::group(['middleware'=>['auth','auto-check-permission'] ,'prefix' => 'admin'],function(){

Route::get('/home','HomeController@index')->name('home');
Route::resource('governorate','GovernorateController');
Route::resource('city','CityController');
Route::resource('category','CategoryController');
Route::resource('client','ClientController');
Route::resource('post','PostController');
Route::post('filter_client','ClientController@filter');
Route::get('filter_client','ClientController@filter');
Route::resource('contact','ContactUsController');
Route::post('filter_contact','ContactUsController@filter');
Route::get('filter_contact','ContactUsController@filter');
Route::resource('donation','DonationRequestController');
Route::post('filter_donation','DonationRequestController@filter');
Route::get('filter_donation','DonationRequestController@filter');
Route::resource('setting','SettingController');
Route::get('user_change_pass','UserController@changePass')->name('user.changePass');
Route::put('user_change_pass_save/{user}','UserController@changePassSave');
Route::resource('user','UserController');
Route::resource('role','RoleController');
});



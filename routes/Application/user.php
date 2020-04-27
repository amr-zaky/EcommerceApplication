<?php
Route::post('/login', 'AuthController@handelLogin');
Route::post('/registration', 'AuthController@handelRegistration');
Route::get('/forget_password', 'AuthController@handelForgetPassword');
Route::post('/check_forgetCode', 'AuthController@checkForgetCode');
Route::post('set_reset_password', 'AuthController@handelUpdateForgetPassword');
Route::post('/change_password','AuthController@changePassword');
Route::post('/getProfile','AuthController@getProfile');
Route::post('/editProfile','AuthController@editProfile');
Route::post('/change_photo','AuthController@changePhoto');
Route::get('/code','AuthController@code');


Route::group(['prefix' =>'home'], function (){
    Route::get('/adds', 'HomePage@adds');

});


Route::group(['prefix' =>'category'], function (){
    Route::get('/main_category_list', 'Categories@mainList');
    Route::get('/sub_category_list', 'Categories@subList');
});

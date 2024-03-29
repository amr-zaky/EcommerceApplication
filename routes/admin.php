<?php
Route::get('/', 'AuthController@login');
Route::get('/login', 'AuthController@login')->name('adminLogin');
Route::post('/login', 'AuthController@handleLogin')->name('handleAdminLogin');
Route::get('/logout', 'AuthController@adminLogout')->name('adminLogout');


Route::group(['middleware' => 'IsAdmin'], function () {
    //Dashboard Home
    Route::get('/home', 'HomeController@home')->name('adminDashboard');

    //admin
    Route::prefix('profile')->group(function (){
        Route::get('/', 'AuthController@profile')->name('profile');
        Route::post('EditProfile', 'AuthController@EditProfile')->name('editProfile');
    });


    //categories
    Route::resource('MainCategory', 'MainCategories');
    Route::get('/MainCategory/changeStatusMainCategory/{MainCategory}', 'MainCategories@changeStatusMainCategory')->name('changeStatusMainCategory');

    Route::resource('SubCategory', 'SubCategoriesController');
    Route::get('/SubCategory/changeStatusSubCategory/{SubCategory}', 'SubCategoriesController@changeStatusSubCategory')->name('changeStatusSubCategory');

    Route::resource('ProductType', 'ProductsType');

    Route::resource('Supplier', 'Suppliers');

    Route::resource('Product', 'Products');
    Route::get('/Product/changeStatusProduct/{Product}', 'Products@changeStatusProduct')->name('changeStatusProduct');
    Route::delete('DeleteImage/{ProductImage}', 'Products@deleteProductImage')->name('deleteProductImage');
    Route::delete('DeleteKeyword/{ProductKeyword}', 'Products@deleteProductKeyword')->name('deleteProductKeyword');
    Route::delete('DeleteRate/{ProductRate}', 'Products@deleteProductRate')->name('deleteProductRate');


    Route::resource('ProductTypeUnit', 'ProductTypeUnites');

    Route::resource('Ad', 'AdsController');


    Route::resource('Offer', 'Offers');
    Route::get('/Ad/changeStatusOffer/{Offer}', 'Offers@changeStatusOffer')->name('changeStatusOffer');
});

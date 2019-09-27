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

Route::group(['middleware'=>['web','auth:admin'],'prefix'=>'article','namespace'=>'\Modules\Article\Http\Controllers'],function(){
    Route::resource('adminCategory', 'AdminCategoryController');
    Route::post('adminCategory/list', 'AdminCategoryController@list')->name('adminCategory.list')->middleware('permission:admin');
    Route::post('adminCategory/sort', 'AdminCategoryController@sort')->name('adminCategory.sort')->middleware('permission:admin');
});
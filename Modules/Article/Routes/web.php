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
    Route::get('admin_category/create/{article_category?}', 'AdminCategoryController@create')->name('admin_category.create')->middleware('permission:admin');
    Route::post('admin_category/list', 'AdminCategoryController@list')->name('admin_category.list')->middleware('permission:admin');
    Route::post('admin_category/sort', 'AdminCategoryController@sort')->name('admin_category.sort')->middleware('permission:admin');
    Route::resource('admin_category', 'AdminCategoryController')->parameters(['admin_category'=>'article_category'])->middleware('permission:admin,resource');
});
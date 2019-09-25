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
Route::group(['middleware'=>'web','prefix'=>'admin','namespace'=>'\Modules\Admin\Http\Controllers'],function(){
    Route::name('admin.')->group(function(){
        Auth::routes(['register' => false,'reset'=>false]);
    });
});

Route::group(['middleware'=>['web','auth:admin'],'prefix'=>'admin','namespace'=>'\Modules\Admin\Http\Controllers'],function(){
    Route::get('/', 'AdminController@index');

    Route::resource('admin_user', 'AdminUserController')->middleware('permission:admin,resource');
    
    Route::resource('menu', 'MenuController')->middleware('permission:admin,resource');
    Route::post('menu/list', 'MenuController@list')->name('menu.list')->middleware('permission:admin');
    Route::post('menu/getMenu', 'MenuController@getMenu')->name('menu.getMenu')->middleware('permission:admin');
    Route::post('menu/sort', 'MenuController@sort')->name('menu.sort')->middleware('permission:admin');

    Route::resource('role', 'RoleController')->middleware('permission:admin,resource');
    Route::get('role/permission/{role}', 'RoleController@permission')->middleware('permission:admin');
    Route::post('role/permission/{role}', 'RoleController@permissionStore')->middleware('permission:admin');

    Route::resource('permission', 'PermissionController')->middleware('permission:admin,resource');
    Route::post('permission/list', 'PermissionController@list')->name('permission.list')->middleware('permission:admin');
});
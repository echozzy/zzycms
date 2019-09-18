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
    Route::resource('menu', 'MenuController');
    Route::post('/menu/list', 'MenuController@list')->name('menu.list');
    Route::post('/menu/getMenu', 'MenuController@getMenu')->name('menu.getMenu');
    Route::post('/menu/sort', 'MenuController@sort')->name('menu.sort');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::post('/permission/list', 'PermissionController@list')->name('permission.list');
});
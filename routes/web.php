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
    return view('index');
});
Route::get('admin', 'AdminController@index');
Route::resource('group', 'GroupController', ['parameters'=>['group'=>'id']]);
Route::resource('family', 'FamilyController', ['parameters'=>['family'=>'id']]);
Route::resource('category', 'CategoryController', ['parameters'=>['category'=>'id']]);
Route::resource('subcategory', 'SubcategoryController', ['parameters'=>['subcategory'=>'id']]);
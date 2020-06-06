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

// Route::get('/', 'HomeController@speedtest');
Route::get('/home', 'HomeController@index');

Route::get('/admin', 'AdminController@showAll');

Route::get('/poster/edit/{id}', 'PosterManagementController@showEditingPage');
Route::post('/poster/edit', 'PosterManagementController@edit');
Route::get('/poster/delete/{id}', 'PosterManagementController@delete');
Route::get('/poster/add', 'PosterManagementController@showAddingPage');
Route::post('/poster/add', 'PosterManagementController@add');

Route::get('/poster/view/{id}', 'HomeController@showDetailPoster');

Route::get('/category/edit/{id}', 'CategoryManagementController@showEditingPage');
Route::get('/category/delete/{id}', 'CategoryManagementController@delete');
Route::post('/category/edit', 'CategoryManagementController@edit');
Route::get('/category/add', 'CategoryManagementController@showAddingPage');
Route::post('/category/add', 'CategoryManagementController@add');


Route::get('image-upload', 'ImageUploadController@imageUpload')->name('image.upload');


Auth::routes();


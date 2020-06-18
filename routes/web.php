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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/search', 'HomeController@search');
Route::get('/home/{categoryId}', 'HomeController@index');

Route::middleware([\App\Http\Middleware\CheckActiveAccount::class])->group(function () {
	Route::get('/poster', 'PosterManagementController@index');
	Route::get('/poster/approve/{id}', 'PosterManagementController@approve');
	Route::get('/poster/edit/{id}', 'PosterManagementController@showEditingPage');
	Route::post('/poster/edit', 'PosterManagementController@edit');
	Route::get('/poster/delete/{id}', 'PosterManagementController@delete');
	Route::get('/poster/add', 'PosterManagementController@showAddingPage');
	Route::post('/poster/add', 'PosterManagementController@add');
	
	Route::get('/poster/view/{id}', 'HomeController@showDetailPoster');
	Route::get('/poster/view/private/{id}', 'HomeController@showDetailPrivatePoster');
	
	Route::get('/category', 'CategoryManagementController@index');
	Route::get('/category/edit/{id}', 'CategoryManagementController@showEditingPage');
	Route::get('/category/delete/{id}', 'CategoryManagementController@delete');
	Route::post('/category/edit', 'CategoryManagementController@edit');
	Route::get('/category/add', 'CategoryManagementController@showAddingPage');
	Route::post('/category/add', 'CategoryManagementController@add');
	
	Route::post('comment/all/{id}', "CommentManagementController@getAllComment");
	Route::post('comment/push', "CommentManagementController@push");
	Route::post('comment/like', "CommentManagementController@like");
});

Route::middleware([\App\Http\Middleware\CheckMasterRole::class])->group(function () {
	Route::get('/accounts', 'AccountManagementController@index');
	Route::get('/accounts/edit/{id}', 'AccountManagementController@showEditingPage');
	Route::post('/accounts/edit', 'AccountManagementController@edit');
	Route::get('/accounts/block/{id}', 'AccountManagementController@block');
	Route::get('/accounts/unblock/{id}', 'AccountManagementController@unblock');
});

Route::get('image-upload', 'ImageUploadController@imageUpload')->name('image.upload');
Route::get('logout', 'Auth\LoginController@logout');


Auth::routes();


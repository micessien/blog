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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', "PagesController@getIndex");
    Route::get('about', "PagesController@getAbout");
    Route::get('contact', "PagesController@getContact");
    // All route posts - make it separate to personalize slug
    Route::resource('posts', 'PostController', ['except' => ['show']]);
    Route::get('posts/{post}-{slug}', "PostController@show")->name('posts.show');
    //
});
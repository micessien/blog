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
    // Categories
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);
    // Tags
    Route::resource('tags', 'TagController', ['except' => ['create']]);
    // Comments
    Route::post('comments/{post_id}', ['uses'=>'CommentsController@store', 'as' => 'comments.store']);
    Route::get('comments/{id}/edit', ['uses'=>'CommentsController@edit', 'as' => 'comments.edit']);
    Route::put('comments/{id}', ['uses'=>'CommentsController@update', 'as' => 'comments.update']);
    Route::delete('comments/{id}', ['uses'=>'CommentsController@destroy', 'as' => 'comments.destroy']);
    Route::get('comments/{id}/delete', ['uses'=>'CommentsController@delete', 'as' => 'comments.delete']);

    Route::get('blog/{post}-{slug}', 'BlogController@getSingle')->name('blog.single');
    Route::get('blog', 'BlogController@getIndex')->name('blog.index');
    Route::get('/', "PagesController@getIndex");
    Route::get('about', "PagesController@getAbout");
    Route::get('contact', "PagesController@getContact");
    // All route posts - make it separate to personalize slug
    Route::resource('posts', 'PostController', ['except' => ['show']]);
    Route::get('posts/{post}-{slug}', "PostController@show")->name('posts.show');
    //
});
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

use App\Category;
use App\Post;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontEndController@index')->name('index');

Route::get('post/{slug}', 'FrontEndController@singlePost')->name('post.single');

Route::get('category/{category}/page', 'FrontEndController@category')->name('category.single');

Route::get('tag/{tag}/page', 'FrontEndController@tag')->name('tag.single');

Route::get('results', function () {
    $posts = Post::where('title', 'like', '%'.request('query').'%')->get();
    return view('results')
        ->with('post', $posts)
        ->with('title', 'Search results : ' . request('query'))
        ->with('settings', Setting::first())
        ->with('categories', Category::take(5)->get())
        ->with('query', request('query'));
})->name('results');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::get('post/create', 'PostsController@create')->name('post.create');
    Route::get('posts', 'PostsController@index')->name('posts.index');
    Route::post('post/store', 'PostsController@store')->name('post.store');
    Route::put('post/{post}/update', 'PostsController@update')->name('post.update');
    Route::get('post/{post}/edit', 'PostsController@edit')->name('post.edit');
    Route::get('post/{id}/delete', 'PostsController@destroy')->name('post.delete');
    Route::get('trash', 'PostsController@trash')->name('trash.index');
    Route::put('restore/{post}/posts', 'PostsController@restore')->name('restore-posts');

    Route::get('category/create', 'CategoryController@create')->name('category.create');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('category/{id}/update', 'CategoryController@update')->name('category.update');
    Route::delete('category/{id}/delete', 'CategoryController@destroy')->name('category.delete');

    Route::get('tags', 'TagController@index')->name('tags.index');
    Route::get('tag/{id}/edit', 'TagController@edit')->name('tag.edit');
    Route::put('tag/{id}/update', 'TagController@update')->name('tag.update');
    Route::get('tag/{id}/delete', 'TagController@destroy')->name('tag.delete');
    Route::post('tag/store', 'TagController@store')->name('tag.store');
    Route::get('tag/create', 'TagController@create')->name('tag.create');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('user/store', 'UserController@store')->name('user.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('user/{user}/update', 'UserController@update')->name('user.update');

    Route::get('user/profile', 'ProfileController@index')->name('user.profile');
    Route::post('user/profile/update', 'ProfileController@update')->name('user.profile.update');

    Route::get('site/settings', 'SettingController@index')->name('settings');
    Route::post('settings/update', 'SettingController@update')->name('settings.update');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('make/{user}/admin', 'UserController@admin')->name('user.admin');
        Route::get('user/{user}/delete', 'UserController@destroy')->name('user.delete');
    });

});

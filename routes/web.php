<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('', 'PageController@landing')->name('landing');

Route::get('contact', 'PageController@contact')->name('contact');

/*
? Menggunakan Parameter
* Route::get('test/{id}/{naga}', 'PageController@test')->name('test');
 */

/* 
? Routing Group
    * Route::prefix('test')->group(function () {
    *   Route::get('', function () {
    *       echo "test";
    *   });
    *   Route::get('makimura', function () {
    *       echo "Makimura";
    *   });
    *   Route::get('shouka/{id}', function ($id) {
    *       echo $id;
    *   });
    * });
 */

Route::resource('blogpost', 'BlogPostController');
Route::resource('user', 'UserController')->only(['show', 'edit', 'update']);
// * Agar bisa mendapatkan blogpost id nya pada store
Route::resource('blogpost.comment', 'CommentController')->only(['store', 'edit', 'update', 'destroy']);

Auth::routes();

// * Mengamankan Route Menggunakan Gate
Route::get('secret', 'PageController@secret')->name('secret')->middleware('can:page.secret');

Route::get('blogpost/tag/{tag_id}', 'BlogPostTagController@index')->name('blogpost.tags.index');

/* 
    ? Cara Mengamankan Route

    * 1. Dengan Menggunakan Atribut Middleware Langsung Pada Route. contoh : 
    ! Route::resource('blogpost', 'BlogPostController')->middleware('auth');
    
    * 2. Dengan Menggunakan Controller. 
    ! contoh bisa dicheck di BlogPostController.php
*/
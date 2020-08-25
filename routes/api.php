<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* Cara memberi nama pada group route
* silahkan check php artisan route:list
*/

// * Diberi namespace agar tidak tertukar dengan controller lainnya dan langsung mengarah ke direktori controllernya
// * Sesuia direktori folder
Route::prefix('v1')->name('api.v1.')->namespace('Api\V1')->group(function () {
    Route::get('/status', function () {
        return response()->json(['status' => 'ok']);
    })->name('status');

    // ! php artisan make:controller Api/V1/PostCommentController --api
    Route::apiResource('blogpost.comment', 'PostCommentController');
    Route::apiResource('tag', 'TagController');
    Route::get('blogpost/{tag?}', 'BlogPostController@getBlogPost')->name('getBlogPost');
    Route::post('login', 'AuthenticationUserController@login')->name('loginApi');
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Not Found'
    ], 404);
});

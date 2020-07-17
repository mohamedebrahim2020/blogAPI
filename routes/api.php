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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Author registration 
Route::post('/register','UserController@register');

//Author login
Route::post('/login','UserController@login');

//Author create a blog
Route::post('/store','BlogController@store')->middleware('auth:api');

//blog lists
Route::get('/blogs','BlogController@index');

//show blog
Route::get('/showblog/{blog}','BlogController@showBlog');

//store comment
Route::post('/comment/{blog}','CommentController@storeComment');
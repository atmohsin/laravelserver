<?php

use Illuminate\Http\Request;

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

Route::get('/productlist', 'ProductController@productlist');
Route::get('/products/{id}', 'ProductController@show');
Route::resource('posts', 'API\PostAPIController');
Route::resource('heroes', 'API\HeroAPIController');
//Route::resource('users', 'API\UserAPIController');

Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
    Route::resource('users', 'API\UserAPIController');
});

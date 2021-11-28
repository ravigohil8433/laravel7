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

Route::post('encrypt', 'Api\CryptController@encrypt');
Route::post('decrypt', 'Api\CryptController@decrypt');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
  
    Route::group([ 'middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
    });
});

Route::group([ 'middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('list', 'Api\CategoryController@index');
        Route::post('create', 'Api\CategoryController@create');
        Route::delete('delete', 'Api\CategoryController@delete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('list', 'Api\ProductController@index');
        Route::post('create', 'Api\ProductController@create');
        Route::delete('delete', 'Api\ProductController@delete');
    });
});
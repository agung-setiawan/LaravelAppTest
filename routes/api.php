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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('user/register', [App\Http\Controllers\PassportAuthController::class, 'register']);
Route::post('user/login', [App\Http\Controllers\PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

	Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

	    Route::get('user', 'ApiController@index');

	    Route::get('user/find/{id}', 'ApiController@show');

	    Route::post('user/update/{id}', 'ApiController@update');

	    Route::get('user/delete/{id}', 'ApiController@destroy');
	});

});

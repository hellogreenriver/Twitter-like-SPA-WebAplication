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



Route::get('/tomotter' , 'App\Http\Controllers\ApiController@index');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get('/individual' , 'App\Http\Controllers\ApiController@personalTweet' );
    Route::post('/tweet', 'App\Http\Controllers\ApiController@create');
    Route::delete('/delete/{id}', 'App\Http\Controllers\ApiController@delete');
    Route::get('/search', 'App\Http\Controllers\ApiController@search');
    Route::post('/logout', 'App\Http\Controllers\LoginController@logout');
});

Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/register','App\Http\Controllers\RegisterController@register');



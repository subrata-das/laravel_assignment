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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => "/v1", 'namespace' => "v1"],function(){
    // COURSE CONROLLER ROUTE
    Route::get('/courseList','courseController@index');
    Route::get('/courseShow/{id}','courseController@show');

    Route::put('/courseUpdate/{id}','courseController@update');

    Route::delete('/courseDestroy/{id}','courseController@destroy');

    Route::post('/courseStore','courseController@store');
    // COURSE END

    // STUDENT CONROLLER ROUTE
    Route::get('/studentList','studentController@index');
    Route::get('/studentShow/{id}','studentController@show');
    Route::post('/studentFilter','studentController@filfer');

    Route::put('/studentUpdate/{id}','studentController@update');

    Route::delete('/studentDestroy/{id}','studentController@destroy');

    Route::post('/studentStore','studentController@store');
    // STUDENT END
});

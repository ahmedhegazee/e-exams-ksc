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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    //login routes
    Route::group(['prefix' => 'login'], function () {
        Route::post('professor', 'AuthController@professorLogin');
        Route::post('admin', 'AuthController@adminLogin');
        Route::post('student', 'AuthController@studentLogin');
    });
    //register routes
    Route::group(['prefix' => 'register'], function () {
        // Route::post('professor','AuthController@professorRegister');
        // Route::post('admin','AuthController@adminRegister');
        // Route::post('student','AuthController@studentRegister');
    });
    //student routes
    Route::group(['prefix' => 'student', 'middleware' => 'auth:students_api'], function () {
    });
    //admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins_api'], function () {
    });
    //professor routes
    Route::group(['prefix' => 'professor', 'middleware' => 'auth:professors_api'], function () {
    });
});
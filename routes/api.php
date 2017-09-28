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

Route::post('register', 'ApiAuth\ApiAuthController@register');
Route::post('login', 'ApiAuth\ApiAuthController@login');

Route::middleware(['jwt.auth'])->group(function () {

    Route::get('logout', 'ApiAuth\ApiAuthController@logout');

    Route::middleware(['check.role:user'])->group(function () {
        Route::get('testSecurity', function () {
            return response()->json(\Illuminate\Support\Facades\Auth::user());
        });
    });

});

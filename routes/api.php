<?php

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

Route::post('login', 'ApiAuth\ApiAuthController@login');

Route::middleware(['jwt.auth.ext'])->group(function () {

    Route::get('me', 'ApiAuth\ApiAuthController@me');
    Route::get('logout', 'ApiAuth\ApiAuthController@logout');
    Route::get('testSecurity', function () {
        return response()->json(Auth::user()->role);
    });

    Route::group([
        'namespace' => 'User',
        'middleware' => 'check.role:user',
        'prefix' => 'user'
    ], function () {
        //User Routes Here
    });

    Route::group([
        'namespace' => 'Admin',
        'middleware' => 'check.role:admin',
        'prefix' => 'admin'
    ], function () {
        //Admin Routes Here
    });

    Route::group([
        'namespace' => 'SuperAdmin',
        'middleware' => 'check.role:superadmin',
        'prefix' => 'superadmin'
    ], function () {
        //Admin Routes Here

        //TODO convert to RESOURCE route (somehow?)
        Route::get('get-user-list', "UserController@getUserList");
        Route::get('get-role-list', "UserController@getRoleList");
        Route::post('set-user-role', "UserController@setUserRole");
        Route::post('create-user', 'UserController@createUser');
        Route::post('set-user-ban', 'UserController@setUserBan');
    });



});

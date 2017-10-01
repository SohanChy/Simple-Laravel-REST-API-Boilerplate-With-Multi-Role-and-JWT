<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return \App\JsonReturn::error("This is a land of API consumers, browsers aren't welcome here"
        . "                                                                                           We will build a wall & make the browsers pay for it.");
});

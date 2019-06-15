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
    return view('welcome');
});
Route::get('curl','Api\OneController@curl');
Route::get('curlone','Api\OneController@curlone');
Route::get('menu','Api\OneController@menu');
Route::get('mi','Api\OneController@mi');
Route::get('Symmetric','Api\OneController@Symmetric');
Route::get('FSymmetric','Api\OneController@FSymmetric');
Route::get('payGo','Api\PayController@payGo');

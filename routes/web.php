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
Route::get('Symmetric','Api\OneController@Symmetric');    //对称加密
Route::get('FSymmetric','Api\OneController@FSymmetric');  //非对称加密
Route::get('payGo','Api\PayController@payGo');            //支付宝支付

Route::post('reg','Api\OneController@reg');
Route::post('login','Api\OneController@login');

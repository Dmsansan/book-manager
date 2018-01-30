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

// Route::get('/', function () {
//     return view('welcome');
// });
/**
 * 首页
 */
Route::get('/','LoginController@loginView');

/**
 * 登录验证
 */
Route::match(['get','post'],'login','LoginController@login');

/**
 * 后台首页
 */
Route::get('index','IndexController@indexView');

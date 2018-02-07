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

//首页
Route::get('/','LoginController@loginView');

//登录验证
Route::match(['get','post'],'login','LoginController@login');

//后台首页
Route::get('index','IndexController@indexView');

/*---------------------------------系统接口--------------------------------------*/
Route::match(['get','post'],'system/getAllEdit','System\SystemController@getAllEdit');
Route::match(['get','post'],'system/getAllManager','System\SystemController@getAllManager');

/*------------------------------用户管理-------------------------------------*/
//用户管理页面
Route::get('user/list','UserController@userList');
//用户列表
Route::get('findUserList','UserController@findUserList');
//用户add和update界面
Route::get('userAddView','UserController@userAddView');
//根据userID获取用户信息
Route::post('getUserInfo','UserController@getUserInfo');
//add或者update用户信息
Route::post('changeUserInfo','UserController@changeUserInfo');
//deleteUser
Route::post('deleteUser','UserController@deleteUser');

/*---------------------------权限管理-------------------------------------*/
//权限管理界面
Route::get('authority/list','Authority\AuthController@authList');
//获取权限列表数据
Route::get('authority/getAuthList','Authority\AuthController@getAuthList');
//跳转权限添加页面
Route::get('authority/authAddView','Authority\AuthController@authAddView');
//新增或者删除权限接口
Route::match(['get','post'],'authority/changeAuthInfo','Authority\AuthController@changeAuthInfo');
//根据authID获取信息
Route::match(['get','post'],'authority/getAuthInfo','Authority\AuthController@getAuthInfo');
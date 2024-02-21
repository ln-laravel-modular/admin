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

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@view_index');
    Route::get('/index2', 'AdminController@view_index2');
    Route::get('/index3', 'AdminController@view_index3');
    Route::get('/register', 'AdminController@view_register');
    Route::get('/login', 'AdminController@view_login');
    Route::get('/forget-password', 'AdminController@view_forget_password');
    Route::get('/config', 'AdminController@view_config');

    Route::get('/module-market', 'AdminController@view_module_market');
    Route::get('/module-installed', 'AdminController@view_module_installed');
});

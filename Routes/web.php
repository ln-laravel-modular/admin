<?php

use App\Support\Helpers\ModuleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\Admin\Http\Controllers\AdminController;

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

Route::prefix(ModuleHelper::current_config('web.prefix'))->group(function () {
    Route::get('/', 'AdminController@view_index');
    Route::post('/', function (Request $request) {
        // $user = new User(['name' => 'guest', 'password' => 'guest', 'email' => 'guest@guest']);
        // Auth::login($user, true);
        return redirect('/admin');
    });
    Route::get('/index2', 'AdminController@view_index2');
    Route::get('/index3', 'AdminController@view_index3');
    Route::get('/register', 'AdminController@view_register');
    Route::get('/login', 'AdminController@view_login');

    Route::get('/forget-password', 'AdminController@view_forget_password');
    Route::get('/config', 'AdminController@view_config');

    // Route::prefix('module-market')->group(function () {
    //     Route::get('/', 'AdminController@view_module_market');
    //     Route::get('/{slug}', 'AdminController@view_module_market_intro');
    //     Route::get('/{slug}/install', 'AdminController@view_module_market_install');
    // });
    // Route::get('/module-installed', 'AdminController@view_module_installed');

    Route::prefix('{module}')->group(function () {
        Route::prefix('{table}')->where(['table' => '(metas|contents|comments|links)'])->group(function () {
            Route::get('/insert', function (Request $request, $module, $table) {
                return AdminController::view('admin::modules.' . substr($table, 0, -1));
            });
            Route::get('/update/{id}', function (Request $request, $module, $table, $cid) {
                return AdminController::view('admin::modules.' . substr($table, 0, -1));
            });
            Route::get('/select/{id}', function (Request $request, $module, $table, $cid) {
                return AdminController::view('admin::modules.' . substr($table, 0, -1));
            });
            Route::get('/{id?}', function (Request $request, $module, $table, $cid = null) {
                return AdminController::view('admin::modules.' . $table);
            });
        });
        Route::get('/options', function (Request $request, $module) {
            return AdminController::view('admin::modules.options');
        });
        Route::get('/themes', function (Request $request, $module) {
            return AdminController::view('admin::modules.themes');
        });
        Route::get('/extras', function (Request $request, $module) {
            return AdminController::view('admin::modules.extras');
        });
    });
    // Route::get('/{module}/contents/{parentCid?}', function (Request $request, $module, $parentCid = null) {
    //     return AdminController::view('admin::modules.contents');
    // });
    // Route::get('/{module}/metas/{parentMid?}', function (Request $request, $module, $parentMid = null) {
    //     $metas = \App\Models\Meta::paginate(20);
    //     return AdminController::view('admin::modules.metas', ['module' => $module, 'parentMid' => $parentMid, 'metas' => $metas]);
    // });
    // Route::get('/{module}/metas/{mid?}', function (Request $request, $module) {
    //     return AdminController::view('admin::modules.meta');
    // });
    // Route::get('/{module}/contents/{parentCid?}', function (Request $request, $module, $parentCid = null) {
    //     return AdminController::view('admin::modules.contents');
    // });
    // Route::get('/{module}/content/{cid?}', function (Request $request, $module) {
    //     return AdminController::view('admin::modules.content');
    // });
    // Route::get('/{module}/links/{parentLid?}', function (Request $request, $module, $parentLid = null) {
    //     return AdminController::view('admin::modules.content');
    // });
    // Route::get('/{module}/link/{lid?}', function (Request $request, $module, $lid) {
    //     return AdminController::view('admin::modules.link');
    // });

});
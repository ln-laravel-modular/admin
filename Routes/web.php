<?php

use App\Support\Helpers\ModuleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Http\Controllers\AdminController;
use App\Support\Module;

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

// var_dump(Module::current());
// var_dump(Module::currentConfig('name'));
Route::prefix(Module::currentConfig('web.prefix'))->group(function () {
    Route::get('/', 'AdminController@view_index');
    Route::match(['get', 'post'], '/register', 'AdminController@view_register');
    Route::match(['get', 'post'], '/login', 'AdminController@view_login');
    Route::match(['get', 'post'], '/forgot-password', 'AdminController@view_forgot_password');
    Route::get('/config', 'AdminController@view_config');
    Route::prefix('system')->group(function () {
        Route::match(['get', 'post'], '/artisan', 'AdminController@view_admin_system_artisan');
        Route::match(['get', 'post'], '/config', 'AdminController@view_admin_modules_config');
        Route::match(['get'], '/modules', 'AdminController@view_admin_system_modules');
        Route::match(['get', 'post'], '/modules/{table}', 'AdminController@view_admin_system_modules_config')
            ->where(['module' => '(' . implode('|', array_filter(array_values(Module::allConfig('web.prefix')), function ($value) {
                return $value !== strtolower(Module::current());
            })) . ')']);
    });

    /**
     * TODO 根据模块配置自动
     */
    Route::prefix('{module}')
        ->where(['module' => '(' . implode('|', array_filter(array_values(Module::allConfig('web.prefix')), function ($value) {
            return $value !== strtolower(Module::current());
        })) . ')'])
        ->group(function () {
            Route::match(['get', 'post'], '', 'AdminController@view_admin_modules_index');
            Route::prefix('{table}')->where(['table' => '(metas|contents|comments|links)'])->group(function () {
                Route::get('', 'AdminController@view_admin_modules_select_list');

                Route::match(['get', 'post'], '/insert', 'AdminController@view_admin_modules_insert_item');

                Route::match(['get', 'post'], '/{id}', 'AdminController@view_admin_modules_select_item')->where(['id' => '[0-9]+']);
            });
            // Route::match(['get', 'post'], '/config', 'AdminController@view_admin_modules_config');
        });
    // Route::prefix('module-market')->group(function () {
    //     Route::get('/', 'AdminController@view_module_market');
    //     Route::get('/{slug}', 'AdminController@view_module_market_intro');
    //     Route::get('/{slug}/install', 'AdminController@view_module_market_install');
    // });
    // Route::get('/module-installed', 'AdminController@view_module_installed');

    // Route::prefix('{module}')->group(function () {
    //     Route::prefix('{table}')->where(['table' => '(metas|contents|comments|links)'])->group(function () {
    //         Route::get('/insert', function (Request $request, $module, $table) {
    //             $return = [
    //                 'view' => 'admin::admin.modules.' . substr($table, 0, -1),
    //             ];
    //             return AdminController::view($return['view'], $return);
    //         });

    //         Route::get('/{id}', function (Request $request, $module, $table, $id) {
    //             $return = [
    //                 'view' => 'admin::admin.modules.' . substr($table, 0, -1),
    //                 'readonly' => true,
    //             ];
    //             $return['detail'] = DB::table('video_contents')->where('cid', $id)->first();
    //             return AdminController::view($return['view'], $return);
    //         });
    //         Route::get('', function (Request $request, $module, $table, $id = null) {
    //             $return = [
    //                 'view' => 'admin::admin.modules.' . $table,
    //                 'readonly' => true,
    //             ];

    //             $return['paginator'] = DB::table('video_contents')->paginate(15);
    //             return AdminController::view($return['view'], $return);
    //         });
    //     });
    //     Route::get('/options', function (Request $request, $module) {
    //         return AdminController::view('admin::admin.modules.options');
    //     });
    //     Route::get('/themes', function (Request $request, $module) {
    //         return AdminController::view('admin::admin.modules.themes');
    //     });
    //     Route::get('/extras', function (Request $request, $module) {
    //         return AdminController::view('admin::admin.modules.extras');
    //     });
    // });
    // Route::get('/update/{id}', function (Request $request, $module, $table, $id) {
    //     $return = [
    //         'view' => 'admin::admin.modules.' . substr($table, 0, -1),
    //     ];
    //     return AdminController::view($return['view'], $return);
    // });
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

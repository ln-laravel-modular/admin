<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    use ViewTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

trait ViewTrait
{
    function view_register(Request $request)
    {
        return view('admin::register', ['module_config' => Config::get('admin')]);
    }
    function view_login(Request $request)
    {
        return view('admin::login', ['module_config' => Config::get('admin')]);
    }
    function view_forget_password(Request $request)
    {
        return view('admin::forget-password', ['module_config' => Config::get('admin')]);
    }
    function view_index(Request $request)
    {
        // if (!Auth::check()) {
        //     return  redirect("/admin/login");
        // }
        return view('admin::index', ['module_config' => Config::get('admin')]);
    }
    function view_index2(Request $request)
    {
        return view('admin::index2', ['module_config' => Config::get('admin')]);
    }
    function view_index3(Request $request)
    {
        return view('admin::index3', ['module_config' => Config::get('admin')]);
    }

    function view_config(Request $request)
    {
        return view('admin::config.index', ['module_config' => Config::get('admin')]);
    }
    function view_module_market(Request $request)
    {
        return view('admin::market.index', ['module_config' => Config::get('admin')]);
    }
    function view_module_market_intro(Request $request, $slug)
    {
        return view('admin::market.module-intro', [
            'module_config' => Config::get('admin'),
            'slug' => $slug,
        ]);
    }
    function view_module_market_install(Request $request, $slug)
    {
        $_GET['step'] = $_GET['step'] ?? 1;
        return view('admin::market.module-install', [
            'module_config' => Config::get('admin'),
            'slug' => $slug,
        ]);
    }
    function view_module_installed(Request $request)
    {
        return view('admin::market.index', ['module_config' => Config::get('admin')]);
    }
}
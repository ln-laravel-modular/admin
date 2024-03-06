<?php

namespace Modules\Admin\Http\Controllers;

use App\Support\Helpers\ModuleHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AdminController extends \App\Http\Controllers\Controller
{
    use ApiTrait, ViewTrait;
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

    public static function getSidebarMenu($menu = null, $parent = [])
    {
        $menu = $menu ?? ModuleHelper::config_collapse_all('admin.sidebar');
        $actives = [];
        usort($menu, function ($a, $b) {
            return Arr::get($a, 'order', 0) - Arr::get($b, 'order', 0);
        });
        // 当前路由地址
        $path = '/' . request()->path();
        foreach ($menu as $index => &$item) {
            // unset($item['active']);
            // 重置激活状态
            $item['active'] = false;
            $item['index'] = isset($menu['index']) ? ($menu['index'] . '-' . $index) : "$index";
            $item['path'] = isset($parent['path']) ? ($parent['path'] . $item['path']) :  $item['path'];

            // 判断当前路由地址是否以该地址开头
            // if(preg_match('/^' . str_replace('/', '\/', $item['path']) . '*/', $path));
            if ($path == $item['path']) {
                $item['active'] = true;
                array_unshift($actives, $item);
                // var_dump($actives);
            }
            if (!empty($item['children'])) {
                [$item['children'], $activeTree] = self::getSidebarMenu($item['children'], $item);
                // 根据子元素修改父元素
                $hasActiveChild = sizeof(array_filter($item['children'], function ($subItem) {
                    return !empty($subItem['active']);
                })) > 0;
                if ($hasActiveChild) {
                    $item['active'] = true;
                    $actives = $activeTree;
                    array_unshift($actives, $item);
                    // var_dump($item);
                }
            }
        }
        return [$menu, $actives];
    }

    public static function view($view = null, $data = [], $mergeData = [])
    {
        // var_dump($this->getSidebarMenu());
        $module_config = Config::get('admin');
        [$module_config['menu'], $module_config['menu_actives']] = self::getSidebarMenu(null, ['path' => '/admin']);
        // var_dump(request()->path());
        // var_dump(request()->route());
        // var_dump($module_config['menu_actives']);
        return view($view, array_merge(['module_config' => $module_config], $data, $mergeData));
    }
}
trait ApiTrait
{
    function api_login(Request $request)
    {
    }
    function api_logout(Request $request)
    {
    }
}
trait ViewTrait
{
    function view_register(Request $request)
    {
        return self::view('admin::register');
    }
    function view_login(Request $request)
    {
        return self::view('admin::login');
    }
    function view_forget_password(Request $request)
    {
        return self::view('admin::forget-password');
    }
    function view_index(Request $request)
    {

        // if (!Auth::check()) return redirect("/admin/login");
        return self::view('admin::index');
    }
    function view_index2(Request $request)
    {
        return self::view('admin::index2');
    }
    function view_index3(Request $request)
    {
        return self::view('admin::index3');
    }

    function view_config(Request $request)
    {
        return self::view('admin::config.index');
    }
    function view_module_market(Request $request)
    {
        return self::view('admin::market.index');
    }
    function view_module_market_intro(Request $request, $slug)
    {
        return self::view('admin::market.module-intro', [
            'slug' => $slug,
        ]);
    }
    function view_module_market_install(Request $request, $slug)
    {
        $_GET['step'] = $_GET['step'] ?? 1;
        return self::view('admin::market.module-install', [
            'slug' => $slug,
        ]);
    }
    function view_module_installed(Request $request)
    {
        return self::view('admin::market.index');
    }
}
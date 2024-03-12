<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Nwidart\Modules\Commands\ModelMakeCommand;
use Nwidart\Modules\Module;

class AdminController extends \App\Http\Controllers\Controller
{
    use ApiTrait, ViewTrait, ViewWebTrait, ViewAdminTrait;
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
        $menu = $menu ?? Module::allConfigCollapse('admin.sidebar');
        $actives = [];
        // order 排序
        usort($menu, function ($a, $b) {
            return Arr::get($a, 'order', 0) - Arr::get($b, 'order', 0);
        });
        // 当前路由地址
        $path = '/' . request()->path();
        // 当前路由正则
        $regex = request()->route()->compiled->getRegex();

        // var_dump([$path, $uri]);
        foreach ($menu as $index => &$item) {
            // unset($item['active']);
            // 重置激活状态
            $item['active'] = false;
            $item['index'] = isset($menu['index']) ? ($menu['index'] . '-' . $index) : "$index";
            $item['path'] = isset($parent['path']) ? ($parent['path'] . $item['path']) :  $item['path'];

            // var_dump([$item['path'], $path, $regex, preg_match($regex, $item['path'])]);
            // 判断当前路由地址是否以该地址开头
            // if(preg_match('/^' . str_replace('/', '\/', $item['path']) . '*/', $path));
            if ($path == $item['path'] || (preg_match($regex, $item['path']) && substr($path, 0, strlen($parent['path'])) == $parent['path'])) {
                $item['active'] = true;
                array_unshift($actives, $item);
                // dump($regex, $parent['path'], $item['path']);
            }
            // var_dump(preg_match('/^' . str_replace('/', '\/', $item['path']) . '*/', $path));
            if (!empty($item['children']) && $item['active'] == false) {
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
        // var_dump($actives);
        return [$menu, $actives];
    }

    public static function view($view = null, $data = [], $mergeData = [])
    {
        // var_dump($this->getSidebarMenu());
        $module_config = Config::get('admin');
        [$module_config['menu'], $module_config['menu_actives']] = self::getSidebarMenu(null, ['path' => '/admin']);
        // var_dump(request()->path());
        // var_dump(request()->route());
        // var_dump($module_config['menu']);
        // dump($module_config['menu']);
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
    function api_modules_insert_item(Request $request)
    {
    }
    function api_modules_delete_item(Request $request)
    {
    }
    function api_modules_update_item(Request $request)
    {
    }
    function api_modules_select_list(Request $request)
    {
    }
}

trait ActionTrait
{
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
        return self::view('admin::admin.config.index');
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

trait ViewWebTrait
{
}

trait ViewAdminTrait
{
    function view_admin_modules_insert_item(Request $request, $module, $table)
    {
        $return = [
            'view' => 'admin::admin.modules.' . substr($table, 0, -1),
            'entities' => Module::currentConfig('entities', $module),
        ];
        foreach ($return['entities'] as $entity) {
            if (strtolower(basename($entity)) === strtolower($module . substr($table, 0, -1))) {
                $return['entity'] = $entity;
                break;
            }
        }
        if (empty($return['entity'])) abort(404);
        $return['detail'] = new $return['entity'];
        if ($request->method() == 'POST') {
            $return['detail']->fill($request->input());
            $return['detail']->save();
            $id = $return['detail']->{$return['detail']->getKeyName()};
            return redirect("/admin/" . $module . "/" . $table . '/' . $id);
        }

        return self::view($return['view'], $return);
    }
    //
    function view_admin_modules_select_item(Request $request, $module, $table, $id)
    {
        $return = [
            'view' => 'admin::admin.modules.' . substr($table, 0, -1),
            'entities' => Module::currentConfig('entities', $module),
        ];
        foreach ($return['entities'] as $entity) {
            if (strtolower(basename($entity)) === strtolower($module . substr($table, 0, -1))) {
                $return['entity'] = $entity;
                break;
            }
        }
        if (empty($return['entity'])) abort(404);
        $return['detail'] =  $return['entity']::find($id);
        if ($request->method() == 'POST') {
            $return['detail']->fill($request->input());
            $return['detail']->save();
        }
        return self::view($return['view'], $return);
    }
    //
    function view_admin_modules_select_list(Request $request, $module, $table)
    {

        $return = [
            'view' => 'admin::admin.modules.' . $table,
            'entities' => Module::currentConfig('entities', $module),
        ];
        foreach ($return['entities'] as $entity) {
            if (strtolower(basename($entity)) === strtolower($module . substr($table, 0, -1))) {
                $return['entity'] = $entity;
                break;
            }
        }
        if (empty($return['entity'])) abort(404);
        $return['paginator'] = $return['entity']::paginate(15);
        return self::view($return['view'], $return);
    }

    // TODO:
    function view_admin_modules_config(Request $request, $module)
    {
        $return = [
            'prefix' => '',
            '$request' => $request->all(),
            'files' => app('files')->allFiles('modules\\' . Module::currentConfig('name', $module)),
            'view' => 'admin::admin.modules.config',
            'config' => Module::currentConfig(null, $module),
            'structure' => [],
        ];
        if ($request->method() == 'POST') {
            var_dump($request->input());
            var_dump($request->all());

            if (in_array($request->input('_target'), array_keys(config('modules.config.update-keys')))) {
                foreach (config('modules.config.update-keys.' . $request->input('_target')) as $key) {
                    $return['config'][$key] = $request->input($key, Module::currentConfig($key));
                }
            }

            // if (in_array($request->input('_target'), ['make-model'])) {
            //     Artisan::call('module:' . $request->input('_target'),  [
            //         'module' => Module::currentConfig('name', $module),
            //         'command' => $request->input('command'),
            //         'model' => $request->input('model'),
            //     ]);
            //     var_dump(Module::setCurrentConfig(null, $return['config'], $module));
            // }
            // switch ($request->input('_target')) {
            //     case 'make-model':
            //
            //         // $res = new \Nwidart\Modules\Commands\ModelMakeCommand;
            //         // var_dump($res->handle('ToDoMeta ToDo'));
            //         Artisan::call('module:make-model', [
            //             'model' => "ToDoMeta",
            //             'module' => "ToDo"
            //         ]);
            //         break;
            //     default:
            //         break;
            // }
            Module::setCurrentConfig(null, $return['config'], $module);
        }



        foreach ($return['files'] as $file) {
            foreach (config('modules.config.files') ?? [] as $key => $path) {
                if (!isset($return[$key])) $return[$key] = [];
                if (substr($file->getRelativePathName(), 0, strlen($path)) == $path) {
                    array_push($return[$key], $file);
                    break;
                }
            }
        }

        // var_dump($request->input());
        // var_dump($return);
        return self::view($return['view'], $return);
    }
}

<?php

return array(
    'name' => 'Admin',
    'slug' => 'admin',
    'title' => 'Laravel Modular',
    'prefix' => 'admin',
    'key' => '',
    'md5' => '',
    'component' => NULL,
    'ui' => 'adminlte',
    'layout' => 'adminlte',
    'theme' => 'master',
    'web' =>
    array(
        'prefix' => NULL,
    ),
    'navbar' =>
    array(
        'prefix' => NULL,
    ),
    'sidebar' =>
    array(
        'prefix' => NULL,
    ),
    'admin' =>
    array(
        'sidebar' =>
        array(
            0 =>
            array(
                'path' => '',
                'title' => '总览面板',
                'icon' => 'fas fa-tachometer-alt',
                'slug' => '',
                'order' => -1,
                'children' =>
                array(
                    0 =>
                    array(
                        'path' => '',
                        'title' => 'Dashboard v1',
                        'children' =>
                        array(),
                    ),
                    1 =>
                    array(
                        'path' => '/index2',
                        'title' => 'Dashboard v2',
                        'children' =>
                        array(),
                    ),
                    2 =>
                    array(
                        'path' => '/index3',
                        'title' => 'Dashboard v3',
                        'children' =>
                        array(),
                    ),
                ),
            ),
            1 =>
            array(
                'path' => '/user',
                'title' => '用户管理',
                'icon' => 'fas fa-users',
                'slug' => '',
                'children' =>
                array(),
            ),
            2 =>
            array(
                'path' => '/system',
                'title' => '系统管理',
                'icon' => 'fab fa-windows',
                'slug' => '',
                'order' => 9223372036854775807,
                'children' =>
                array(
                    0 =>
                    array(
                        'path' => '/config',
                        'title' => '配置管理',
                        'children' =>
                        array(),
                    ),
                    1 =>
                    array(
                        'path' => '/menu',
                        'title' => '目录管理',
                        'children' =>
                        array(),
                    ),
                    2 =>
                    array(
                        'path' => '/data',
                        'title' => '数据管理',
                        'children' =>
                        array(),
                    ),
                    3 =>
                    array(
                        'path' => '/artisan',
                        'title' => '命令管理',
                        'children' =>
                        array(),
                    ),
                    4 =>
                    array(
                        'path' => '/modules',
                        'title' => '应用管理',
                        'children' =>
                        array(
                            array(
                                'path' => '/{module}',
                                'title' => 'Config',
                                'visible' => false,
                            ),
                        ),
                    ),
                ),
            ),
            3 =>
            array(
                'path' => '',
                'title' => 'Dashboard',
                'icon' => '',
                'slug' => '',
                'visible' => false,
                'badge' =>
                array(
                    'type' => '',
                    'value' => '',
                ),
                'children' =>
                array(),
            ),
        ),
    ),
    'controllers' =>
    array(
        0 => '\\Modules\\Admin\\Http\\Controllers\\AdminController',
    ),
    'seeders' =>
    array(
        0 => '\\Modules\\Admin\\Database\\Seeders\\AdminDatabaseSeeder',
    ),
    'entities' =>
    array(),
    'factories' =>
    array(),
    'migrations' =>
    array(),
    'type' => 'project',
    'description' => NULL,
);

<?php


namespace workspace\modules\adminlte;


use core\App;

class Adminlte
{

    public static function run()
    {
        $config['adminTopMenu'] = [
            [
                'title' => 'Home',
                'url' => '#',
                'icon' => '',
            ],
            [
                'title' => 'Contact',
                'url' => 'page',
                'icon' => '',
            ],
        ];

        $config['adminLeftMenu'] = [
            [
                'title' => 'Статьи',
                'url' => '#',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
                'sub' => [
                    [
                        'title' => 'Добавить',
                        'url' => 'url/add'
                    ],
                    [
                        'title' => 'Список',
                        'url' => 'url/list'
                    ],
                ]
            ],
            [
                'title' => 'Статистика',
                'url' => 'page',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];
        App::$config['adminLayoutPath'] = '/modules/adminlte/views/layouts/';
        App::mergeConfig($config);
    }
}
<?php


namespace workspace\modules\adminlte;


use core\App;

class Adminlte
{

    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Пользователи',
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
                'title' => 'Страница',
                'url' => 'page',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];
        App::mergeConfig($config);
    }

}
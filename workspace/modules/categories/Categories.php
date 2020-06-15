<?php

namespace workspace\modules\categories;


use core\App;

class Categories
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Categories',
                'url' => '/categories',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
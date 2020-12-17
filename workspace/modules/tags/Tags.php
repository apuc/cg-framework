<?php

namespace workspace\modules\tags;


use core\App;

class Tags
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Теги',
                'url' => '/tags',
                'icon' => '<i class="nav-icon fa fa-users"></i>', //TODO
            ],
        ];

        App::mergeConfig($config);
    }
}
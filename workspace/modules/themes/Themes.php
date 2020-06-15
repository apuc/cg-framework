<?php

namespace workspace\modules\themes;


use core\App;

class Themes
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Themes',
                'url' => '/themes',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
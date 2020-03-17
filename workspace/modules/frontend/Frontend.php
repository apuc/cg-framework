<?php

namespace workspace\modules\frontend;


use core\App;

class Frontend
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Frontend',
                'url' => '/',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
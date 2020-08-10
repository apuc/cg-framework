<?php

namespace workspace\modules\tour;


use core\App;

class Tour
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Tour',
                'url' => '/admin/tour',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
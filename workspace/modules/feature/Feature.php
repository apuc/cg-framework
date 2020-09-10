<?php

namespace workspace\modules\feature;


use core\App;

class Feature
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Feature',
                'url' => '/admin/feature',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
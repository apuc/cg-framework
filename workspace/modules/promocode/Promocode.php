<?php

namespace workspace\modules\promocode;


use core\App;

class Promocode
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Promocodes',
                'url' => '/promocode',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
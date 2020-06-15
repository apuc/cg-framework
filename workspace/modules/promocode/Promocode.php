<?php

namespace workspace\modules\promocode;


use core\App;

class Promocode
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Промокоды',
                'url' => '/admin/promocode',
                'icon' => '<i class="fas fa-window-maximize"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
<?php

namespace workspace\modules\settings;


use core\App;

class Settings
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Настройки',
                'url' => '/settings',
                'icon' => '<i class="fas fa-cogs"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
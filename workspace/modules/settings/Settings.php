<?php

namespace workspace\modules\settings;


use core\App;

class Settings
{
    public static function run()
    {
        $config['settings'] = [
            [
                'title' => '',
                'url' => '',
                'icon' => '',
            ],
        ];

        App::mergeConfig($config);
    }
}
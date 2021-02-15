<?php

namespace workspace\modules\rule;


use core\App;

class Rule
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Права',
                'url' => '/admin/rules',
                'icon' => '<i class="fas fa-gavel"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
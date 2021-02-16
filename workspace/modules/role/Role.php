<?php

namespace workspace\modules\role;


use core\App;

class Role
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Роли',
                'url' => '/admin/roles',
                'icon' => '<i class="fas fa-id-badge"></i>',
            ],
            [
                'title' => 'Права',
                'url' => '/admin/rules',
                'icon' => '<i class="fas fa-gavel"></i>',
            ]
        ];

        App::mergeConfig($config);
    }
}
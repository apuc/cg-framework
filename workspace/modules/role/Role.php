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
        ];

        App::mergeConfig($config);
    }
}
<?php

namespace workspace\modules\users;


use core\App;

class Users
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Users',
                'url' => '/users',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
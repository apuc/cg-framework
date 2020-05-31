<?php

namespace workspace\modules\product;


use core\App;

class Product
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Товары',
                'url' => '/admin/product',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
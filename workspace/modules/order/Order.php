<?php

namespace workspace\modules\order;


use core\App;

class Order
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Заказы',
                'url' => '/admin/order',
                'icon' => '<i class="fas fa-border-none"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
<?php

namespace workspace\modules\article;


use core\App;

class Article
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Статьи',
                'url' => '/admin/article',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
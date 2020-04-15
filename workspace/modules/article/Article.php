<?php

namespace workspace\modules\article;


use core\App;

class Article
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Articles',
                'url' => '/article',
                'icon' => '<i class="nav-icon fas fa-copy"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
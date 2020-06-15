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
                'icon' => '<i class="fas fa-newspaper"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}
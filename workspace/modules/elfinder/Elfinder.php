<?php


namespace workspace\modules\elfinder;


use core\App;

class Elfinder
{

    public static function run()
    {
        $config['adminTopMenu'] = [
//            [
//                'title' => 'Elfinder',
//                'url' => 'admin/elfinder',
//                'icon' => '',
//            ],
        ];

        $config['adminLeftMenu'] = [
            [
                'title' => 'Elfinder',
                'url' => 'admin/elfinder',
                'icon' => '<i class="fas fa-folder-open"></i>',
            ],
        ];

        App::mergeConfig($config);

        App::$breadcrumbs->addSetting('class', 'breadcrumbs');
    }

}
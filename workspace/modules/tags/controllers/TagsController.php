<?php

namespace workspace\modules\tags\controllers;


use core\App;
use core\Controller;
use core\Debug;


class TagsController extends Controller
{
    protected function init()
    {
        /* TODO
        $this->viewPath = '/modules/tags/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        */
    }

    public function actionIndex()
    {
        /* TODO
        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'items' => [
                [
                    'text' => 'AdminPanel',
                ],
            ],
        ];

        return $this->render('admin/index.tpl', ['h1' => 'AdminLte', 'bc_options' => $bc_options]);
        */
    }
}
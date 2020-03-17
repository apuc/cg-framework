<?php

namespace workspace\modules\themes\controllers;

use core\App;
use core\Controller;
use workspace\models\Settings;

class ThemesController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/themes/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Themes', 'url' => 'themes']);
    }

    public function actionIndex()
    {
        $dirs = scandir(WORKSPACE_DIR . '/modules/themes/themes/');
        unset($dirs[0]); unset($dirs[1]);

        $themes = array();
        foreach ($dirs as $key => $value)
            array_push($themes, new \Theme($key, $value));

        $model = Settings::where('key', 'theme')->first();

        $options = [
            'fields' => [
                'theme' => 'Тема',
            ],
            'baseUri' => 'themes'
        ];

        if(isset($_POST['theme'])) {
            $model->value = $_POST['theme'];
            $model->save();
        }
        return $this->render('themes/index.tpl', ['h1' => 'Index', 'themes' => $themes, 'model' => $model, 'options' => $options]);
    }
}
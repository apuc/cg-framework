<?php


namespace workspace\modules\settings\controllers;


use core\App;
use core\Controller;
use workspace\models\Settings;

class SettingsController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/settings/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
    }

    public $viewPath = '/modules/settings/views/';

    public function actionIndex()
    {
        $settings = Settings::all();

        $options = [
            ['show' => ['val', 'key']]
        ];
        return $this->render('settings/settings.tpl',
            ['h1' => 'Settings', 'settings' => $settings, 'options' => $options]);
    }

    public function actionStore()
    {

    }

    public function actionEdit($id)
    {

    }

    public function actionDelete($id)
    {

    }

    public function actionView($id)
    {

    }
}
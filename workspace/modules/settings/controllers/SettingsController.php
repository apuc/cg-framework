<?php


namespace workspace\modules\settings\controllers;


use core\Controller;

class SettingsController extends Controller
{
    public $viewPath = '/modules/settings/views/';

    public function actionIndex()
    {
        return $this->render('settings/settings.tpl', ['h1' => 'Settings']);
    }
}
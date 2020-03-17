<?php

namespace workspace\modules\frontend\controllers;

use core\Controller;
use workspace\models\Settings;

class FrontendController extends Controller
{
    public $viewPath = '/modules/themes/themes/';

    public function actionIndex()
    {
        $theme = Settings::where('key', 'theme')->first();

        try {
            return $this->render($theme->value.'/index.tpl', ['h1' => 'Site with']);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
}
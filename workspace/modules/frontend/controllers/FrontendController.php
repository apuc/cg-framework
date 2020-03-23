<?php

namespace workspace\modules\frontend\controllers;

use core\Controller;
use core\Debug;
use workspace\models\Category;
use workspace\models\Settings;
use workspace\models\Article;

class FrontendController extends Controller
{
    public $viewPath = '/modules/themes/themes/';

    public function actionIndex()
    {
        $theme = Settings::where('key', 'theme')->first();
        $articles = Article::all();
        $categories = Category::all();

        try {
            return $this->render($theme->value.'/index.tpl', ['articles' => $articles, 'categories' => $categories]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
    public function actionCategory()
    {
        $theme = Settings::where('key', 'theme')->first();

        try {
            return $this->render($theme->value.'/category.tpl');
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
    public function actionRead()
    {
        $theme = Settings::where('key', 'theme')->first();

        try {
            return $this->render($theme->value.'/article.tpl');
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
}
<?php

namespace workspace\modules\frontend\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\models\ArticleCategory;
use workspace\models\Category;
use workspace\models\Settings;
use workspace\models\Article;

class FrontendController extends Controller
{
    public $viewPath = '/modules/themes/themes/';

    public function actionIndex()
    {
        $theme = Settings::where('key', 'theme')->first();
        $articles = Article::all()->sortByDesc("updated_at");
        $categories = Category::all();
        $article_category = ArticleCategory::all();

        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
        }
        else {
            $username = '';
            $role = '';
        }

        try {
            return $this->render($theme->value . '/index.tpl',
                ['articles' => $articles, 'categories' => $categories, 'article_category' => $article_category,
                    'amount' => 3, 'popular' => 10, 'username' => $username, 'role' => $role]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl');
        }
    }

    public function actionCategory($id)
    {
        $theme = Settings::where('key', 'theme')->first();
        $categories = Category::all();
        $articles = Article::where('category_id', $id)->get();
        $articles = $articles->sortByDesc('updated_at');

        try {
            return $this->render($theme->value . '/category.tpl', ['categories' => $categories, 'articles' => $articles]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }

    public function actionRead($id)
    {
        $theme = Settings::where('key', 'theme')->first();
        $article = Article::where('id', $id)->first();
        $categories = Category::all();
        $articles = Article::all()->sortByDesc("updated_at");

        try {
            return $this->render($theme->value . '/article.tpl',
                ['article' => $article, 'categories' => $categories, 'articles' => $articles, 'popular' => 10]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['article' => $article]);
        }
    }

    public function actionAbout()
    {
        $theme = Settings::where('key', 'theme')->first();

        try {
            return $this->render($theme->value . '/about.tpl');
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
}
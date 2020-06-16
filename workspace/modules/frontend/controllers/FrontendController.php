<?php

namespace workspace\modules\frontend\controllers;

use core\component_manager\lib\Mod;
use core\Controller;
use core\Debug;
use workspace\models\ArticleCategory;
use workspace\models\Category;
use workspace\models\Settings;
use workspace\models\Article;

class FrontendController extends Controller
{
    public $viewPath = '/modules/themes/themes/';

    protected function init()
    {
        $mod = new Mod();
        $active = $mod->getByStatus('active');
        $theme = 'default';
        foreach ($active as $key => $item)
            if($item['type'] == 'theme') {
                $theme = $key;
                break;
            }

        $this->layoutPath = '/modules/themes/themes/' . $theme . '/layouts/';
    }

    public function actionIndex()
    {
        //$settings = Settings::where('key', 'title')->first();
        $this->view->setTitle('Home');

        $theme = Settings::where('key', 'theme')->first();
        $articles = Article::all()->sortByDesc("updated_at");
        $categories = Category::all();
        $article_category = ArticleCategory::all();

        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];

        } else {
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
        $category = Category::where('id', $id)->first();
        $settings = Settings::where('key', 'title')->first();
        $this->view->setTitle($category->category);

        $theme = Settings::where('key', 'theme')->first();
        $categories = Category::all();
        $articles_ids = ArticleCategory::where('category_id', $id)->get();
        $articles_ids = $articles_ids->sortByDesc('updated_at');

        $articles = array();
        foreach ($articles_ids as $item) {
            $article = Article::where('id', $item->article_id)->get();
            foreach ($article as $value)
                array_push($articles,
                    new \workspace\classes\Article($value->id, $value->name, $value->text, $value->language_id,
                        $value->image_name, $value->image, $value->parent_id, '', '',
                        $value->description, '', ''));
        }

        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
        }
        else {
            $username = '';
            $role = '';
        }

//        foreach ($articles as $article)
//            Debug::prn($article->name);
//        Debug::dd('');

        try {
            return $this->render($theme->value . '/category.tpl', ['categories' => $categories,
                'articles' => $articles, 'username' => $username, 'role' => $role]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }

    public function actionRead($id)
    {
        $article = Article::where('id', $id)->first();
        $settings = Settings::where('key', 'title')->first();
        $this->view->setTitle($article->name);

        $theme = Settings::where('key', 'theme')->first();
        $article = Article::where('id', $id)->first();
        $categories = Category::all();
        $articles = Article::all()->sortByDesc("updated_at");

        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
        }
        else {
            $username = '';
            $role = '';
        }

        try {
            return $this->render($theme->value . '/article.tpl',
                ['article' => $article, 'categories' => $categories, 'articles' => $articles, 'popular' => 10,
                    'username' => $username, 'role' => $role]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['article' => $article]);
        }
    }

    public function actionAbout()
    {
        $settings = Settings::where('key', 'title')->first();
        $this->view->setTitle('About');

        $theme = Settings::where('key', 'theme')->first();

        if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
        }
        else {
            $username = '';
            $role = '';
        }

        try {
            return $this->render($theme->value . '/about.tpl', ['username' => $username, 'role' => $role]);
        } catch (\Exception $e) {
            return $this->render('default/index.tpl', ['h1' => 'Site with']);
        }
    }
}
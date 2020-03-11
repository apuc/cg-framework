<?php
namespace workspace\modules\article\controllers;


use core\App;
use core\Controller;
use workspace\models\Article;
use workspace\models\Language;

class ArticleController extends Controller
{
    public $viewPath = '/modules/article/views/';

    protected function init()
    {
        $this->viewPath = '/modules/article/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
    }

    public function actionIndex()
    {
        $model = Article::all();

        $options = [
            'serial' => '#',
            'fields' => [
                [
                    'name' => 'Заголовок',
                    'text' => 'Статья',
                    'language' => [
                        'label' => 'Язык',
                        'value' => function($model) {
                            $language = Language::where('id', $model->language_id)->first();
                            return $language->name;
                        }
                    ]
                ]
            ],
            'baseUri' => 'article',
        ];

        return $this->render('article/article.tpl',
            ['h1' => 'Статьи', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Article::where('id', $id)->first();

        $options = [
            'fields' => [
                'name' => 'Заголовок',
                'text' => 'Статья',
                'language' => [
                    'label' => 'Язык',
                    'value' => function($model) {
                        $language = Language::where('id', $model->language_id)->first();
                        return $language->name;
                    }
                ],
            ],
        ];

        return $this->render('article/view.tpl', ['h1' => 'View', 'id' => $id, 'model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['text'])) {
            $article = new Article();
            $article->name = $_POST['name'];
            $article->text = $_POST['text'];
            $article->language_id = $_POST['language_id'];
            $article->save();

            $this->redirect('article');
        } else {
            $language = Language::all();

            $lang = array();
            foreach ($language as $value)
                $lang[$value->id] = $value->name;

            return $this->render('article/store.tpl', ['h1' => 'Create', 'language' => $lang]);
        }
    }

    public function actionEdit($id)
    {
        $article = Article::where('id', $id)->first();

        if(isset($_POST['name']) && isset($_POST['text'])) {
            $article->name = $_POST['name'];
            $article->text = $_POST['text'];
            $article->save();

            $this->redirect('article');
        } else {
            $language = Language::all();

            $lang = array();
            foreach ($language as $value)
                $lang[$value->id] = $value->name;

            return $this->render('article/edit.tpl', ['h1' => 'Edit', 'id' => $id, 'article' => $article, 'language' => $lang]);
        }

    }

    public function actionDelete()
    {
        Article::where('id', $_POST['id'])->delete();
    }
}
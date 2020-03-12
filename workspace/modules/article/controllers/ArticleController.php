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

        $bc_options = [
            'class' => 'bc',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Articles',
            'module_url' => 'article',
        ];

        return $this->render('article/article.tpl',
            ['h1' => 'Статьи', 'model' => $model, 'options' => $options, 'bc_options' => $bc_options]);
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

        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Articles',
            'module_url' => 'article',
            'item' => function($id) {
                $model = Article::where('id', $id)->first();

                return $model->name;
            },
            'item_id' => $id,
            'action' => 'View'
        ];

        return $this->render('article/view.tpl',
            ['h1' => 'View', 'id' => $id, 'model' => $model, 'options' => $options, 'bc_options' => $bc_options]);
    }

    public function actionStore()
    {
        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Articles',
            'module_url' => 'article',
            'action' => 'Create'
        ];

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

            return $this->render('article/store.tpl',
                ['h1' => 'Create', 'language' => $lang, 'bc_options' => $bc_options]);
        }
    }

    public function actionEdit($id)
    {
        $article = Article::where('id', $id)->first();

        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Articles',
            'module_url' => 'article',
            'item' => function($id) {
                $model = Article::where('id', $id)->first();

                return $model->name;
            },
            'item_id' => $id,
            'action' => 'Edit'
        ];

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

            return $this->render('article/edit.tpl',
                ['h1' => 'Edit', 'id' => $id, 'article' => $article, 'language' => $lang, 'bc_options' => $bc_options]);
        }

    }

    public function actionDelete()
    {
        Article::where('id', $_POST['id'])->delete();
    }
}
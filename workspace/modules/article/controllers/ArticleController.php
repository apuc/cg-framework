<?php
namespace workspace\modules\article\controllers;


use core\App;
use core\Controller;
use core\Debug;
use workspace\models\Article;
use workspace\models\Category;
use workspace\models\Language;

class ArticleController extends Controller
{
    public $viewPath = '/modules/article/views/';

    protected function init()
    {
        $this->viewPath = '/modules/article/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Articles', 'url' => 'article']);
    }

    public function actionIndex()
    {
        $model = Article::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => 'Заголовок',
                'text' => 'Статья',
                'language' => [
                    'label' => 'Язык',
                    'value' => function($model) {
                        $language = Language::where('id', $model->language_id)->first();
                        return $language->name;
                    }
                ]
            ],
            'baseUri' => 'article',
            'pagination' => [
                'per_page' => 25,
                'class' => '',
                'class-active' => ''
            ],
        ];

        return $this->render('article/article.tpl', ['h1' => 'Статьи', 'model' => $model, 'options' => $options]);
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
                        $loc_model = Language::where('id', $model->language_id)->first();
                        return $loc_model->name;
                    }
                ],
                'category' => [
                    'label' => 'Категория',
                    'value' => function($model) {
                        $loc_model = Category::where('id', $model->category_id)->first();
                        return $loc_model->category;
                    }
                ],
                'image' => 'Картинка'
            ],
        ];

        return $this->render('article/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['text'])) {
            $article = new Article();
            $this->saveArticle($article);

            $this->redirect('article');
        } else {
            $languages = $this->getArray(Language::all(), 'name');
            $categories = $this->getArray(Category::all(), 'category');

            return $this->render('article/store.tpl',
                ['h1' => 'Добавить статью', 'language' => $languages, 'categories' => $categories]);
        }
    }

    public function actionEdit($id)
    {
        $model = Article::where('id', $id)->first();

        if(isset($_POST['name']) && isset($_POST['text'])) {
            $this->saveArticle($model);

            $this->redirect('article');
        } else {
            $languages = $this->getArray(Language::all(), 'name');
            $categories = $this->getArray(Category::all(), 'category');

            return $this->render('article/edit.tpl',
                ['h1' => 'Редактировать: ', 'model' => $model, 'languages' => $languages, 'categories' => $categories]);
        }
    }

    public function actionDelete()
    {
        Article::where('id', $_POST['id'])->delete();
    }

    public function saveArticle($model) {
        $model->name = $_POST['name'];
        $model->text = $_POST['text'];
        $model->language_id = $_POST['language_id'];
        $model->category_id = $_POST['category_id'];
        $model->image_name = $_POST['image'];
        $model->image = '<img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/'.$_POST['image'].'" />';
        $model->save();
    }

    public function getArray($model, $field)
    {
        $array = array();
        foreach ($model as $value)
            $array[$value->id] = $value->$field;

        return $array;
    }
}
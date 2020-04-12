<?php
namespace workspace\modules\article\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Schema\Blueprint;
use workspace\models\Article;
use workspace\models\ArticleCategory;
use workspace\models\Category;
use workspace\models\Language;

class ArticleController extends Controller
{
    public $viewPath = '/modules/article/views/';

    protected function init()
    {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/article/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Articles', 'url' => 'article']);
    }

    public function actionIndex()
    {
        $model = Article::all()->sortByDesc("updated_at");

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
                ],
                'title' => 'Title',
                'description' => 'Description',
                'keywords' => 'Keywords',
                'url' => 'URL'
            ],
            'baseUri' => 'article',
            'pagination' => [
                'per_page' => 25,
                'class' => '',
                'class-active' => ''
            ],
        ];

        $categories = Category::all();
        $select_options = [
            'id' => 'category_ids',
            'class' => '',
            'label' => 'Категории:',
            'value' => 'category',
            'value_id' => 'id'
        ];

        return $this->render('article/article.tpl', ['h1' => 'Статьи', 'model' => $model, 'options' => $options,
            'select_options' => $select_options, 'categories' => $categories]);
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
                        $ac = ArticleCategory::where('article_id', $model->id)->get();
                        $category = '';
                        foreach ($ac as $item) {
                            $c = Category::where('id', $item->category_id)->first();
                            $category .= $c->category . ', ';
                        }
                        $category = substr($category, 0, -2);

                        return $category;
                    }
                ],
                'image' => 'Картинка',
                'title' => 'Title',
                'description' => 'Description',
                'keywords' => 'Keywords',
                'url' => 'URL'
            ],
        ];

        return $this->render('article/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['text'])) {
            $article = new Article();
            $data = new \workspace\classes\Article($article->id, $_POST['name'], $_POST['text'], $_POST['language_id'],
                '', $_POST['image'], 0, $_POST['category_id'], $_POST['title'], $_POST['description'],
                $_POST['keywords'], $_POST['url']);

            Article::saveLocalArticle($article, $data);
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
        $ac = ArticleCategory::where('article_id', $model->id)->get();
        foreach ($ac as $item) {
            $category_id = $item->category_id;
            break;
        }

        if(isset($_POST['name']) && isset($_POST['text'])) {
            $data = new \workspace\classes\Article($model->id, $_POST['name'], $_POST['text'], $_POST['language_id'],
                '', $_POST['image'], 0, $_POST['category_id'], $_POST['title'], $_POST['description'],
                $_POST['keywords'], $_POST['url']);
            Article::editLocalArticle($model, $data);

            $this->redirect('article');
        } else {
            $languages = $this->getArray(Language::all(), 'name');
            $categories = $this->getArray(Category::all(), 'category');

            $categories_obj = Category::all();

            $select_options = [
                'id' => 'category_ids',
                'class' => '',
                'label' => 'Категории:',
                'value' => 'category',
                'value_id' => 'id'
            ];

            return $this->render('article/edit.tpl',
                ['h1' => 'Редактировать: ', 'model' => $model, 'languages' => $languages, 'categories' => $categories,
                    'category_id' => $category_id, 'select_options' => $select_options, 'categories_obj' => $categories_obj]);
        }
    }

    public function actionDelete()
    {
        Article::where('id', $_POST['id'])->delete();
    }

    public function getArray($model, $field)
    {
        $array = array();
        foreach ($model as $value)
            $array[$value->id] = $value->$field;

        return $array;
    }
}
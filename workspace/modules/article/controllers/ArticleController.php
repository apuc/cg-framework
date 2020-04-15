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
use workspace\models\Settings;

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
                'category' => [
                    'label' => 'Категории',
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
                    'label' => 'Категории',
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
            $article->name = '';
            $article->text = '';
            $article->image_name = '';
            $article->image = '';
            $article->parent_id = 0;
            $article->language_id = 0;
            $article->save();

            $settings = Settings::where('key', 'title')->first();

            Article::saveLocalArticle($article, $this->formData($article, $settings));

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

            return $this->render('article/store.tpl',
                ['h1' => 'Добавить статью', 'language' => $languages, 'categories' => $categories,
                    'select_options' => $select_options, 'categories_obj' => $categories_obj]);
        }
    }

    public function actionEdit($id)
    {
        $model = Article::where('id', $id)->first();

        $selected = array();
        $ac = ArticleCategory::where('article_id', $model->id)->get();
        foreach ($ac as $value)
            array_push($selected, $value->category_id);

        if(isset($_POST['name']) && isset($_POST['text'])) {
            $settings = Settings::where('key', 'title')->first();

            Article::saveLocalArticle($model, $this->formData($model, $settings));

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
                    'select_options' => $select_options, 'categories_obj' => $categories_obj, 'selected_categories' => $selected]);
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

    public function formData($model, $settings)
    {
        return new \workspace\classes\Article($model->id,
            $_POST['name'], $_POST['text'], $_POST['language_id'],
            '', $_POST['image'], 0, $_POST['category_ids'],
            ((isset($_POST['title']) && $_POST['title']) ? $_POST['title'] : $_POST['name'] . ' | ' . $settings->value),
            ((isset($_POST['description']) && $_POST['description']) ? $_POST['description'] : ''),
            ((isset($_POST['keywords']) && $_POST['keywords']) ? $_POST['keywords'] : ''),
            ((isset($_POST['url']) && $_POST['url']) ? $_POST['url'] : $_SERVER['SERVER_NAME'].'/read/'.$model->id));
    }
}
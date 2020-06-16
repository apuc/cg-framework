<?php

namespace workspace\modules\categories\controllers;

use core\App;
use core\Controller;
use workspace\models\Category;
use workspace\modules\categories\requests\CategorySearchRequest;

class CategoriesController extends Controller
{
    public $viewPath = '/modules/categories/views/';

    protected function init()
    {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/categories/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Categories', 'url' => 'categories']);
    }

    public function actionIndex()
    {
        $request = new CategorySearchRequest();
        $model = Category::search($request);

        $options = [
            'serial' => '#',
            'fields' => [
               'category' => 'Категория'
            ],
            'baseUri' => 'categories'
        ];

        return $this->render('categories/index.tpl', ['h1' => 'Категории', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Category::where('id', $id)->first();

        $options = [
            'fields' => [
                'category' => 'Категория'
            ],
        ];

        return $this->render('categories/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['category'])) {
            $model = new Category();
            $model->category = $_POST['category'];
            $model->save();

            $this->redirect('categories');
        } else
            return $this->render('categories/store.tpl', ['h1' => 'Добавить категорию']);
    }

    public function actionEdit($id)
    {
        $model = Category::where('id', $id)->first();

        if(isset($_POST['category'])) {
            $model->category = $_POST['category'];
            $model->save();

            $this->redirect('categories');
        } else
            return $this->render('categories/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Category::where('id', $_POST['id'])->delete();
    }
}
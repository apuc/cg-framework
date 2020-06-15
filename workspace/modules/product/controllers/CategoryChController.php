<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\CategoryCh;

class CategoryChController extends Controller
{
    public $viewPath = '/modules/product/views/categorych';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/categorych';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'categorych']);
    }

    public function actionIndex()
    {
        $model = CategoryCh::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'category_id' => [
                    'label' => 'Category'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('categorych/categorych.tpl', ['h1' => 'categorych', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = CategoryCh::where('id', $id)->first();

        $options = [
            'fields' => [
                'category_id' => 'Category',
                'characteristic_id' => 'Characteristic',
            ],
        ];

        return $this->render('categorych/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['category_id']) && isset($_POST['characteristic_id'])) {
            $model = new CategoryCh();
            $model->category_id = $_POST['category_id'];
            $model->characteristic_id = $_POST['characteristic_id'];
            $model->save();

            $this->redirect('categorych');
        } else
            return $this->render('categorych/store.tpl', ['h1' => 'Добавить categorych']);
    }

    public function actionEdit($id)
    {
        $model = CategoryCh::where('id', $id)->first();

        if(isset($_POST['category_id']) && isset($_POST['characteristic_id'])) {
            $model->category_id = $_POST['category_id'];
            $model->characteristic_id = $_POST['characteristic_id'];
            $model->save();

            $this->redirect('categorych');
        } else
            return $this->render('categorych/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        CategoryCh::where('id', $_POST['id'])->delete();
    }
}

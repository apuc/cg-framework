<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\ProductCat;

class ProductCatController extends Controller
{
    public $viewPath = '/modules/product/views/productcat';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/productcat';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'productcat']);
    }

    public function actionIndex()
    {
        $model = ProductCat::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'cat_id' => [
                    'label' => 'Category'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('productcat/productcat.tpl', ['h1' => 'productcat', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = ProductCat::where('id', $id)->first();

        $options = [
            'fields' => [
                'cat_id' => 'Category',
                'product_id' => 'Product',
            ],
        ];

        return $this->render('productcat/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['cat_id']) && isset($_POST['product_id'])) {
            $model = new ProductCat();
            $model->cat_id = $_POST['cat_id'];
            $model->product_id = $_POST['product_id'];
            $model->save();

            $this->redirect('productcat');
        } else
            return $this->render('productcat/store.tpl', ['h1' => 'Добавить productcat']);
    }

    public function actionEdit($id)
    {
        $model = ProductCat::where('id', $id)->first();

        if(isset($_POST['cat_id']) && isset($_POST['product_id'])) {
            $model->cat_id = $_POST['cat_id'];
            $model->product_id = $_POST['product_id'];
            $model->save();

            $this->redirect('productcat');
        } else
            return $this->render('productcat/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        ProductCat::where('id', $_POST['id'])->delete();
    }
}

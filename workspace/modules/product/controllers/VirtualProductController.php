<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\VirtualProduct;

class VirtualProductController extends Controller
{
    public $viewPath = '/modules/product/views/virtualproduct';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/virtualproduct';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'virtualproduct']);
    }

    public function actionIndex()
    {
        $model = VirtualProduct::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'product_id' => [
                    'label' => 'prod id'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('virtualproduct/virtualproduct.tpl', ['h1' => 'virtualproduct', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = VirtualProduct::where('id', $id)->first();

        $options = [
            'fields' => [
                'price' => 'Цена',
                'product_id' => 'Product',
            ],
        ];

        return $this->render('virtualproduct/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['price']) && isset($_POST['product_id'])) {
            $model = new VirtualProduct();
            $model->name = $_POST['price'];
            $model->title = $_POST['product_id'];
            $model->save();

            $this->redirect('virtualproduct');
        } else
            return $this->render('virtualproduct/store.tpl', ['h1' => 'Добавить virtualproduct']);
    }

    public function actionEdit($id)
    {
        $model = VirtualProduct::where('id', $id)->first();

        if(isset($_POST['price']) && isset($_POST['product_id'])) {
            $model->name = $_POST['price'];
            $model->title = $_POST['product_id'];
            $model->save();

            $this->redirect('virtualproduct');
        } else
            return $this->render('virtualproduct/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        VirtualProduct::where('id', $_POST['id'])->delete();
    }
}

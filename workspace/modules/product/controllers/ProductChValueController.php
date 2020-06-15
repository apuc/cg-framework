<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\ProductChValue;

class ProductChValueController extends Controller
{
    public $viewPath = '/modules/product/views/productchvalue';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/productchvalue';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'productchvalue']);
    }

    public function actionIndex()
    {
        $model = ProductChValue::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'ch_value_id' => [
                    'label' => 'Category'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('productchvalue/productchvalue.tpl', ['h1' => 'productchvalue', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = ProductChValue::where('id', $id)->first();

        $options = [
            'fields' => [
                'ch_value_id' => 'Characteristic value id',
                'product_id' => 'Product id',
            ],
        ];

        return $this->render('productchvalue/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['ch_value_id']) && isset($_POST['product_id'])) {
            $model = new ProductChValue();
            $model->ch_value_id = $_POST['ch_value_id'];
            $model->product_id = $_POST['product_id'];
            $model->save();

            $this->redirect('productchvalue');
        } else
            return $this->render('productchvalue/store.tpl', ['h1' => 'Добавить productchvalue']);
    }

    public function actionEdit($id)
    {
        $model = ProductChValue::where('id', $id)->first();

        if(isset($_POST['ch_value_id']) && isset($_POST['product_id'])) {
            $model->ch_value_id = $_POST['ch_value_id'];
            $model->product_id = $_POST['product_id'];
            $model->save();

            $this->redirect('productchvalue');
        } else
            return $this->render('productchvalue/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        ProductChValue::where('id', $_POST['id'])->delete();
    }
}

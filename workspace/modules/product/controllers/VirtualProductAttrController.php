<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\VirtualProductAttr;

class VirtualProductAttrController extends Controller
{
    public $viewPath = '/modules/product/views/virtualproductattr';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/virtualproductattr';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'virtualproductattr', 'url' => 'virtualproductattr']);
    }

    public function actionIndex()
    {
        $model = VirtualProductAttr::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'virtual_product_id' => [
                    'label' => 'virtual prod id'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('virtualproductattr/virtualproductattr.tpl', ['h1' => 'virtualproductattr', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = VirtualProductAttr::where('id', $id)->first();

        $options = [
            'fields' => [
                'virtual_product_id' => 'номер виртуального продукта',
                'attr_value_id' => 'номер значения атрибута',
                'status' => 'статус',
            ],
        ];

        return $this->render('virtualproductattr/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['virtual_product_id']) && isset($_POST['attr_value_id']) && isset($_POST['status'])) {
            $model = new VirtualProductAttr();
            $model->virtual_product_id = $_POST['virtual_product_id'];
            $model->attr_value_id = $_POST['attr_value_id'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('virtualproductattr');
        } else
            return $this->render('virtualproductattr/store.tpl', ['h1' => 'Добавить virtualproductattr']);
    }

    public function actionEdit($id)
    {
        $model = VirtualProductAttr::where('id', $id)->first();

        if(isset($_POST['virtual_product_id']) && isset($_POST['attr_value_id']) && isset($_POST['status'])) {
            $model->virtual_product_id = $_POST['virtual_product_id'];
            $model->attr_value_id = $_POST['attr_value_id'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('virtualproductattr');
        } else
            return $this->render('virtualproductattr/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        VirtualProductAttr::where('id', $_POST['id'])->delete();
    }
}

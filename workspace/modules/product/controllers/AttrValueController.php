<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\AttrValue;

class AttrValueController extends Controller
{
    public $viewPath = '/modules/product/views/attrvalue';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/attrvalue';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'AttrValue', 'url' => 'attrvalue']);
    }

    public function actionIndex()
    {
        $model = AttrValue::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'attr_id' => [
                    'label' => 'attr_id'
                ],
                'value' => [
                    'label' => 'value'
                ],
            ],
            'baseUri' => 'attrvalue'
        ];

        return $this->render('attrvalue/attrvalue.tpl', ['h1' => 'AttrValue', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = AttrValue::where('id', $id)->first();

        $options = [
            'fields' => [
                'attr_id' => 'attr_id',
                'value' => 'value',
            ],
        ];

        return $this->render('attrvalue/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['value']) && isset($_POST['attr_id'])) {
            $model = new AttrValue();
            $model->attr_id = $_POST['attr_id'];
            $model->value = $_POST['value'];
            $model->save();

            $this->redirect('attrvalue');
        } else
            return $this->render('attrvalue/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = AttrValue::where('id', $id)->first();

        if(isset($_POST['value']) && isset($_POST['attr_id'])) {
            $model->attr_id = $_POST['attr_id'];
            $model->value = $_POST['value'];
            $model->save();

            $this->redirect('attrvalue');
        } else
            return $this->render('attrvalue/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        AttrValue::where('id', $_POST['id'])->delete();
    }
}
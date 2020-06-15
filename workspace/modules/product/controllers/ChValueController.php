<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\ChValue;

class ChValueController extends Controller
{
    public $viewPath = '/modules/product/views/chvalue';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/chvalue';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'chvalue']);
    }

    public function actionIndex()
    {
        $model = ChValue::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'ch_id' => [
                    'label' => 'Характеристика'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('chvalue/chvalue.tpl', ['h1' => 'Характеристика', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = ChValue::where('id', $id)->first();

        $options = [
            'fields' => [
                'ch_id' => 'Название',
                'status' => 'status',
            ],
        ];

        return $this->render('category/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['ch_id']) && isset($_POST['value'])) {
            $model = new ChValue();
            $model->ch_id = $_POST['ch_id'];
            $model->value = $_POST['value'];
            $model->save();

            $this->redirect('chvalue');
        } else
            return $this->render('chvalue/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = ChValue::where('id', $id)->first();

        if(isset($_POST['ch_id']) && isset($_POST['value'])) {
            $model->ch_id = $_POST['ch_id'];
            $model->value = $_POST['value'];
            $model->save();

            $this->redirect('chvalue');
        } else
            return $this->render('chvalue/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        ChValue::where('id', $_POST['id'])->delete();
    }
}

<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\Characteristic;

class CharacteristicController extends Controller
{
    public $viewPath = '/modules/product/views/characteristic';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/characteristic';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'characteristic']);
    }

    public function actionIndex()
    {
        $model = Characteristic::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Характеристика'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('characteristic/characteristic.tpl', ['h1' => 'Характеристика', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Characteristic::where('id', $id)->first();

        $options = [
            'fields' => [
                'name' => 'Название',
                'status' => 'status',
            ],
        ];

        return $this->render('category/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['status'])) {
            $model = new Characteristic();
            $model->name = $_POST['name'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('characteristic');
        } else
            return $this->render('characteristic/store.tpl', ['h1' => 'Добавить характеристику']);
    }

    public function actionEdit($id)
    {
        $model = Characteristic::where('id', $id)->first();

        if(isset($_POST['name']) && isset($_POST['status'])) {
            $model->name = $_POST['name'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('characteristic');
        } else
            return $this->render('characteristic/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Characteristic::where('id', $_POST['id'])->delete();
    }
}

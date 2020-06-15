<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\product\models\Attribute;

class AttributeController extends Controller
{
    public $viewPath = '/modules/product/views/attribute';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/attribute';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'attribute']);
    }

    public function actionIndex()
    {
        $model = Attribute::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Атрибут'
                ],
            ],
            'baseUri' => 'attribute'
        ];

        return $this->render('attribute/attribute.tpl', ['h1' => 'Атрибут', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Attribute::where('id', $id)->first();

        $options = [
            'fields' => [
                'name' => 'Атрибут',
            ],
        ];

        return $this->render('attribute/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name'])) {
            $model = new Attribute();
            $model->name = $_POST['name'];
            $model->save();

            $this->redirect('attribute');
        } else
            return $this->render('attribute/store.tpl', ['h1' => 'Добавить атрибут']);
    }

    public function actionEdit($id)
    {
        $model = Attribute::where('id', $id)->first();

        if(isset($_POST['name'])) {
            $model->name = $_POST['name'];
            $model->save();

            $this->redirect('attribute');
        } else
            return $this->render('attribute/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Attribute::where('id', $_POST['id'])->delete();
    }
}
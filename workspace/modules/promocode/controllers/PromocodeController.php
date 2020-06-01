<?php

namespace workspace\modules\promocode\controllers;

use core\App;
use core\Controller;
use workspace\models\Promocode;

class PromocodeController extends Controller
{
    public $viewPath = '/modules/promocode/views/';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/promocode/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Promocode', 'url' => '/admin/promocode']);
    }

    public function actionIndex()
    {
        $model = Promocode::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Промокод'
                ],
                'discount' => [
                    'label' => 'Скидка %'
                ],
                'active_from' => [
                    'label' => 'Активен с'
                ],
                'active_to' => [
                    'label' => 'Активен по'
                ]
            ],
            'baseUri' => 'promocode'
        ];

        return $this->render('promocode/promocode.tpl', ['h1' => 'Промокоды', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Promocode::where('id', $id)->first();

        $options = [
            'fields' => [
                'name' => 'Промокод',
                'discount' => 'Скидка %',
                'active_from' => 'Активен с',
                'active_to' => 'Активен по',

            ],
        ];

        return $this->render('promocode/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['discount']) && isset($_POST['active_from']) && isset($_POST['active_to'])) {
            $model = new Promocode();
            $model->name = $_POST['name'];
            $model->discount = $_POST['discount'];
            $model->active_from = $_POST['active_from'];
            $model->active_to = $_POST['active_to'];
            $model->save();

            $this->redirect('admin/promocode');
        } else
            return $this->render('promocode/store.tpl', ['h1' => 'Добавить промокод']);
    }

    public function actionEdit($id)
    {
        $model = Promocode::where('id', $id)->first();

        if(isset($_POST['name']) && isset($_POST['discount']) && isset($_POST['active_from']) && isset($_POST['active_to'])) {
            $model->name = $_POST['name'];
            $model->discount = $_POST['discount'];
            $model->active_from = $_POST['active_from'];
            $model->active_to = $_POST['active_to'];
            $model->save();

            $this->redirect('admin/promocode');
        } else
            return $this->render('promocode/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Promocode::where('id', $_POST['id'])->delete();
    }
}
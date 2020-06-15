<?php

namespace workspace\modules\promocode\controllers;

use core\App;
use core\Controller;
use workspace\modules\promocode\models\Promocode;
use workspace\modules\promocode\requests\PromocodeRequest;
use workspace\modules\promocode\requests\PromocodeSearchRequest;

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
        $request = new PromocodeSearchRequest();
        $model = Promocode::search($request);

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

        return $this->render('promocode/promocode.tpl', [
            'h1' => 'Промокоды',
            'model' => $model,
            'options' => $options
        ]);
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
        $request = new PromocodeRequest();
        if($request->isPost() && $request->validate()) {
            $model = new Promocode();
            $model->name = $request->name;
            $model->discount = $request->discount;
            $model->active_from = $request->active_from;
            $model->active_to = $request->active_to;
            $model->save();

            $this->redirect('admin/promocode');
        } else
            return $this->render('promocode/store.tpl', [
                'h1' => 'Добавить промокод',
                'errors' => $request->getMessagesArray(),
                ]);
    }

    public function actionEdit($id)
    {
        $request = new PromocodeRequest();
        $model = Promocode::where('id', $id)->first();

        if($request->isPost() && $request->validate()) {
            $model->name = $request->name;
            $model->discount = $request->discount;
            $model->active_from = $request->active_from;
            $model->active_to = $request->active_to;
            $model->save();

            $this->redirect('admin/promocode');
        } else
            return $this->render('promocode/edit.tpl', [
                'h1' => 'Редактировать: ',
                'model' => $model,
                'errors' => $request->getMessagesArray(),
                ]);
    }

    public function actionDelete()
    {
        Promocode::where('id', $_POST['id'])->delete();
    }
}
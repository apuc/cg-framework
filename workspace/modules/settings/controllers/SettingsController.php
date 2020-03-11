<?php


namespace workspace\modules\settings\controllers;


use core\App;
use core\Controller;
use workspace\models\Settings;

class SettingsController extends Controller
{
    public $viewPath = '/modules/settings/views/';

    protected function init()
    {
        $this->viewPath = '/modules/settings/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
    }

    public function actionIndex()
    {
        $model = Settings::all();

        $options = [
            'serial' => '#',
            'fields' => [
                [
                    'key' => 'Ключ',
                    'category' => [
                        'label' => 'Значение',
                        'value' => function($model) {
                            return $model->value;
                        }
                    ]
                ]
            ],
            'baseUri' => 'settings',
        ];
        return $this->render('settings/settings.tpl',
            ['module' => 'Settings', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Settings::where('id', $id)->first();

        $options = [
            'fields' => [
                'key' => 'key',
                'category' => [
                    'label' => 'value',
                    'value' => function($model) {
                        return $model->value;
                    }
                ]
            ],
        ];

        return $this->render('settings/view.tpl', ['module' => 'settings', 'name' => $model->key, 'model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['key']) && isset($_POST['value'])) {
            $settings = new Settings();
            $settings->key = $_POST['key'];
            $settings->value = $_POST['value'];
            $settings->save();

            $this->redirect('settings');
        } else
            return $this->render('settings/store.tpl', [ 'module' => '<a href="/settings">Settings</a>',
                'view' => 'Create']);
    }

    public function actionEdit($id)
    {
        $settings = Settings::where('id', $id)->first();

        if(isset($_POST['key']) && isset($_POST['value'])) {
            $settings->key = $_POST['key'];
            $settings->value = $_POST['value'];
            $settings->save();

            $this->redirect('settings');
        } else
            return $this->render('settings/edit.tpl', [ 'module' => '<a href="/settings">Settings</a>',
                'view' => 'Edit', 'id' => $id, 'settings' => $settings]);
    }

    public function actionDelete()
    {
        Settings::where('id', $_POST['id'])->delete();
    }
}
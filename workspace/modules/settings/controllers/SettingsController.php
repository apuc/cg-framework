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
        App::$breadcrumbs->addItem(['text' => 'Settings', 'url' => '/settings']);
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

        $bc_options = [];

        return $this->render('settings/settings.tpl', ['h1' => 'Settings', 'model' => $model, 'options' => $options, 'bc_options' => $bc_options]);
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

        $bc_options = [
            'items' => [
                [
                    'text' => $model->key,
                    'url' => 'settings/'.$id,
                    'class' => ''
                ],
            ],
        ];

        return $this->render('settings/view.tpl', ['h1' => $model->key, 'model' => $model, 'options' => $options, 'bc_options' => $bc_options]);
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
            return $this->render('settings/store.tpl', ['h1' => 'Create']);
    }

    public function actionEdit($id)
    {
        $settings = Settings::where('id', $id)->first();

        $bc_options = [
            'items' => [
                [
                    'text' => $settings->key,
                    'url' => 'settings/'.$id,
                    'class' => ''
                ],
                [
                    'text' => 'Edit',
                    'class' => ''
                ],
            ],
        ];

        if(isset($_POST['key']) && isset($_POST['value'])) {
            $settings->key = $_POST['key'];
            $settings->value = $_POST['value'];
            $settings->save();

            $this->redirect('settings');
        } else
            return $this->render('settings/edit.tpl', ['h1' => 'Edit', 'settings' => $settings, 'bc_options' => $bc_options]);
    }

    public function actionDelete()
    {
        Settings::where('id', $_POST['id'])->delete();
    }
}
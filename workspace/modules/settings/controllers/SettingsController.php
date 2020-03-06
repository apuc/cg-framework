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
            ['h1' => 'Settings', 'model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        return $this->render('settings/store.tpl', ['h1' => 'Create']);
    }

    public function actionEdit($id)
    {
        $settings = Settings::where('id', $id)->first();

        if(isset($_POST['key']) && isset($_POST['value'])) {
            $current_settings = Settings::where('key', $_POST['key'])->first();
            $current_settings->key = $_POST['key'];
            $current_settings->value = $_POST['value'];
            $current_settings->save();

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
                ['h1' => 'Settings', 'model' => $model, 'options' => $options]);
        } else
            return $this->render('settings/edit.tpl', ['h1' => 'Edit', 'id' => $id, 'settings' => $settings]);
    }

    public function actionDelete($id)
    {

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

        return $this->render('settings/view.tpl', ['h1' => 'View', 'id' => $id, 'model' => $model, 'options' => $options]);
    }
}
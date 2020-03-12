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

        $bc_options = [
            'class' => 'bc',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Settings',
            'module_url' => 'settings',
        ];

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
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Settings',
            'module_url' => 'settings',
            'item' => function($id) {
                $model = Settings::where('id', $id)->first();

                return $model->key;
            },
            'item_id' => $id,
            'action' => 'View'
        ];

        return $this->render('settings/view.tpl', ['h1' => $model->key, 'model' => $model, 'options' => $options, 'bc_options' => $bc_options]);
    }

    public function actionStore()
    {
        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Settings',
            'module_url' => 'settings',
            'action' => 'Create'
        ];

        if(isset($_POST['key']) && isset($_POST['value'])) {
            $settings = new Settings();
            $settings->key = $_POST['key'];
            $settings->value = $_POST['value'];
            $settings->save();

            $this->redirect('settings');
        } else
            return $this->render('settings/store.tpl', ['h1' => 'Create', 'bc_options' => $bc_options]);
    }

    public function actionEdit($id)
    {
        $settings = Settings::where('id', $id)->first();

        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'main' => 'AdminPanel',
            'main_url' => 'adminlte',
            'module' => 'Settings',
            'module_url' => 'settings',
            'item' => function($id) {
                $model = Settings::where('id', $id)->first();

                return $model->key;
            },
            'item_id' => $id,
            'action' => 'Edit'
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
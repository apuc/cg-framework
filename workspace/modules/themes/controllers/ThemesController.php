<?php

namespace workspace\modules\themes\controllers;

use core\App;
use core\Controller;
use workspace\models\Settings;

class ThemesController extends Controller
{
    protected function init()
    {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/themes/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Themes', 'url' => 'themes']);
    }

    public function actionIndex()
    {
        $theme = Settings::where('key', 'theme')->first();

        $dirs = $this->getDirs();

        $model = array();
        foreach ($dirs as $key => $value)
            array_push($model, $this->formThemeModel($key, $value));

        App::$header->add('Access-Control-Allow-Origin', '*');
        $json = file_get_contents('https://news-parser.craft-group.xyz/api/api/templates');
        $data = json_decode($json);

        $diff = array_udiff($data, $model,
            function ($a, $b) {
                return strcmp($a->theme, $b->theme);
            }
        );

        foreach ($diff as $value)
            array_push($model, $value);

        $options = [
            'serial' => '#',
            'fields' => [
                'action' => [
                    'label' => 'Действие',
                    'value' => function($model) {
                        $theme = Settings::where('key', 'theme')->first();
                        if($theme->value == $model->theme)
                            return '<a class="custom-link" title="Установленная тема" id="'. $model->id .'" href="/" data-theme="'.$model->theme.'"><i class="nav-icon fas fa-check"></i></a> ';
                        elseif($model->status == 'скачано')
                            return '<a class="custom-link action" title="Установить тему" id="'. $model->id .'" href="#" data-theme="'.$model->theme.'"><i class="nav-icon fas fa-cogs"></i></a> ';
                        else
                            return '<a class="custom-link download" title="Скачать тему" id="'. $model->id .'" href="#" data-theme="'.$model->theme.'"><i class="nav-icon fas fa-download"></i></a> ';
                    }
                ],
                'theme' => 'Тема',
                'status' => 'Статус',
                'version' => 'Версия',
                'description' => 'Описание',
                'img' => 'Превью'
            ],
            'baseUri' => 'themes'
        ];

        return $this->render('themes/index.tpl',
            ['h1' => 'Index', 'theme' => $theme, 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $dirs = $this->getDirs();

        $model = $this->formThemeModel($id, $dirs[$id]);

        $options = [
            'fields' => [
                'theme' => 'Тема',
                'version' => 'Версия',
                'description' => 'Описание',
                'img' => 'Превью'
            ],
            'baseUri' => 'themes'
        ];

        return $this->render('themes/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        $model = Settings::where('key', 'theme')->first();

        if(isset($_POST['theme'])) {
            $model->value = $_POST['theme'];
            $model->save();

            $this->redirect('themes');
        }
        else {
            $dirs = $this->getDirs();

            $themes_array = array();
            for($i = 2; $i <= count($dirs) + 1; $i++)
                $themes_array[$dirs[$i]] = $dirs[$i];

            return $this->render('themes/store.tpl', ['current_theme' => $model->value,'themes' => $themes_array]);
        }
    }

    public function actionEdit($id)
    {
        $dirs = $this->getDirs();

        $model = $this->formThemeModel($id, $dirs[$id]);
        $theme = Settings::where('key', 'theme')->first();

        if(isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['version'])) {
            if($model->theme == $theme->value) {
                $theme->value = $_POST['theme'];
                $theme->save();
            }
            rename(WORKSPACE_DIR . '/modules/themes/themes/' . $dirs[$id], WORKSPACE_DIR . '/modules/themes/themes/' . $_POST['theme']);

            $manifest['name'] = $_POST['theme'];
            $manifest['description'] = $_POST['description'];
            $manifest['version'] = $_POST['version'];

            $json = json_encode($manifest);
            file_put_contents(WORKSPACE_DIR . '/modules/themes/themes/' . $dirs[$id] . '/manifest.json', $json);
            $this->redirect('themes');
        } else
            return $this->render('themes/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        $dirs = $this->getDirs();
        rmdir(WORKSPACE_DIR . '/modules/themes/themes/' . $dirs[$_POST['id']]);
    }

    public function formThemeModel($id, $dir)
    {
        $uri = sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME']
        );

        $manifest_json = file_get_contents(WORKSPACE_DIR . '/modules/themes/themes/' . $dir . '/manifest.json');

        $manifest = json_decode($manifest_json, true);

        $img = '<img src="' . $uri . '/workspace/modules/themes/themes/' . $dir . '/preview.jpg" class="img" />';
        return new \Theme($id, $dir, $manifest['description'], $img, $manifest['version'], 'скачано');
    }

    public function getDirs()
    {
        $dirs = scandir(WORKSPACE_DIR . '/modules/themes/themes/');
        unset($dirs[0]); unset($dirs[1]);

        return $dirs;
    }
}
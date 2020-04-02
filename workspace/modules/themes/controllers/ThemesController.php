<?php

namespace workspace\modules\themes\controllers;

use core\App;
use core\component_manager\lib\CmService;
use core\component_manager\lib\Config;
use core\component_manager\lib\Mod;
use core\Controller;
use core\Debug;
use workspace\classes\Button;
use workspace\models\Modules;
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
        App::$header->add('Access-Control-Allow-Origin', '*');
        $content = file_get_contents('https://rep.craft-group.xyz/handler.php');
        $data = json_decode($content);

        $model = array();
        foreach ($data as $value)
            if($value->type == 'theme')
                array_push($model, new Modules($value->name, $value->version, $value->description));

        $theme = Settings::where('key', 'theme')->first();

        $options = [
            'serial' => '#',
            'fields' => [
                'action' => [
                    'label' => '',
                    'value' => function($model) {
                        $mod = new Mod();
                        $button = new Button();

                        if($mod->getModInfo($model->name)['status'] == 'active')
                            return $button->button('', 'Активная тема', $model->name, $model->name, 'check-circle');
                        elseif($mod->getModInfo($model->name)['status'] == 'inactive')
                            return $button->button('theme-set-active', 'Сделать активной темой', $model->name, $model->name, 'toggle-off');
                        else
                            return $button->button('module-download', 'Скачать', $model->name, $model->name, 'download');
                    }
                ],
                'delete' => [
                    'label' => '',
                    'value' => function ($model) {
                        $mod = new Mod();
                        $button = new Button();

                        if ($mod->getModInfo($model->name)['status'] == 'inactive')
                            return $button->button('fixed-width module-delete', 'Удалить', $model->name, $model->name, 'trash');
                        else
                            return '<div class="fixed-width"></div>';
                    }
                ],
                'status' => [
                    'label' => 'Статус',
                    'value' => function($model) {
                        $mod = new Mod();
                        return '<div class="fixed-width">' . $mod->getModInfo($model->name)['status'] . '</div>';
                    }
                ],
                'name' => 'Название',
                'description' => 'Описание',
                'version' => 'Версия',
                'img' => [
                    'label' => "",
                    'value' => function($model) {
                        $mod = new Mod();
                        if($mod->getModInfo($model->name)['status'] != 'not downloaded')
                            return '<img class="img" src="'.Config::get()->byKey('themePath'). $model->name .'/preview.jpg" />';
                        else {
                            $image = 'https://rep.craft-group.xyz/image.php?slug=' . $model->name;
                            $imageData = base64_encode(file_get_contents($image));
                            $src = 'data:image/jpg;base64,' . $imageData;

                            return '<img class="img" src="'.$src.'" />';
                        }
                    }
                ]
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
<?php

namespace workspace\modules\themes\controllers;

use core\App;
use core\component_manager\lib\CM;
use core\component_manager\lib\Config;
use core\component_manager\lib\Mod;
use core\Controller;
use workspace\classes\Button;
use workspace\classes\Modules;
use workspace\models\Settings;

class ThemesController extends Controller
{
    protected function init()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/themes/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Themes', 'url' => 'themes']);
    }

    public function actionIndex()
    {

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

    public function actionSetActiveTheme()
    {
        try {
            $cm = new CM();
            $theme = Settings::where('key', 'theme')->first();
            $cm->modChangeStatusToInactive($theme->value);
            $cm->modChangeStatusToActive($_POST['slug']);
            $theme->value = $_POST['slug'];
            $theme->save();
        } catch (\Exception $e) {
            return $e;
        }
    }
}
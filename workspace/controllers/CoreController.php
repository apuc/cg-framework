<?php


namespace workspace\controllers;


use core\component_manager\lib\CM;
use core\Controller;
use core\GridView;
use core\GridViewHelper;
use core\modules\Modules;
use core\modules\ModulesHandler;
use core\modules\ModulesSearchRequest;

class CoreController extends Controller
{
    public function actionIndexCore()
    {
        $this->view->setTitle('Core');

        $model = ModulesHandler::getCore();

        return $this->render('main/core.tpl', ['options' => $this->setOptions($model)]);
    }

    public function actionDownloadCore()
    {
        $cm = new CM();
        $cm->download($_POST['data'], 'core');

        ModulesHandler::clearRequest();
        $model = ModulesHandler::getCore();

        return GridView::widget($this->setOptions($model))->run();
    }

    public function actionUpdateCore()
    {
        //download core
        //get version and update manifest
        //archive old core
    }

    public function actionUploadCore()
    {

    }

    public function actionSetActiveCore()
    {

    }

    public function actionDeleteCore()
    {

    }

    public function setOptions($data)
    {
        return [
            'data' => $data,
            'serial' => '#',
            'actionBtn' => 'del_all',
            'fields' => [
                'download' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model->name;
                        $version = $model->version;
                        $fl = 0;

                        if ($model->localStatus == 'local')
                            $fl = 1;
                        if ($model->localStatus == 'server' && $fl == 0)
                            return GridViewHelper::button("download-$name", '__cjax', 'Скачать',
                                'cloud-download-alt', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="download-core" data-target="cjax"');
                        elseif ($model->localStatus == 'local')
                            return GridViewHelper::button("update-$name", '__cjax', 'Обновить',
                                'redo', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="update-core" data-target="cjax"');
                        else return GridViewHelper::div('', 'fixed-width');
                    }
                ],
                'upload' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model->name;

                        return ($model->localStatus == 'local')
                            ? GridViewHelper::button("core-upload-$name", '__cjax', 'Загрузить в облако',
                                'cloud-upload-alt', 'data-name="' . $name . '" data-version="' . $model->version
                                . '" data-action="core-upload" data-target="cjax"')
                            : GridViewHelper::div('', 'fixed-width');
                    }
                ],
                'toggle' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model->name;
                        $version = $model->version;
                        $status = $model->status;

                        if ($status == 'active')
                            return GridViewHelper::button("", '', '', 'toggle-on', '');
                        elseif ($status == 'inactive')
                            return GridViewHelper::button("core-set-active-$name", '__cjax', 'Включить',
                                'toggle-off', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="core-set-active" data-target="cjax"');
                        else
                            return GridViewHelper::div('', 'fixed-width');
                    },
                ],
//                'delete' => [
//                    'label' => '',
//                    'showFilter' => false,
//                    'value' => function ($model) {
//                        $name = $model->name;
//
//                        return ($model->localStatus == 'local')
//                            ? GridViewHelper::button("core-delete-$name", '__cjax', 'Удалить',
//                                'trash', 'data-name="' . $name . '" data-version="' . $model->version
//                                . '" data-action="core-delete" data-target="cjax"')
//                            : GridViewHelper::div('', 'fixed-width');
//                    },
//                ],
                'version' => [
                    'label' => 'Версия',
                    'value' => function ($model) {
                        return GridViewHelper::select($model, '__cjax', 'data-name="'
                            . $model->name . '" data-action="change-version" data-target="cjax"');
                    }
                ],
            ],
            'baseUri' => 'modules',
            'pagination' => [
                'per_page' => 10
            ]
        ];
    }
}
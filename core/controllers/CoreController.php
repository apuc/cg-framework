<?php


namespace core\controllers;


use core\component_manager\lib\CM;
use core\component_manager\lib\CmHelper;
use core\component_manager\lib\CmService;
use core\component_manager\lib\CoreHandler;
use core\component_manager\lib\Mod;
use core\Controller;
use core\Debug;
use core\GridView;
use core\GridViewHelper;
use core\ZipCore;

class CoreController extends Controller
{
    public function actionIndexCore()
    {
        $this->view->setTitle('Core');

        return $this->render('main/core.tpl', [
            'options' => $this->setOptions(CoreHandler::getCore())]);
    }

    public function actionDownloadCore()
    {
        $cm = new CM();
        $cm->download($_POST['data'], 'core', "/cloud/core", "/archives/", '');

        CmHelper::clearRequest();

        return GridView::widget($this->setOptions(CoreHandler::getCore()))->run();
    }

    public function actionUpdateCore()
    {

    }

    public function actionUploadCore()
    {

    }

    public function actionSetActiveCore()
    {
        $cm = new CM();
        $mod = new Mod();
        $cms = new CmService();
        $new_version = json_decode($_POST['data'])->version;
        $current_version = json_decode(file_get_contents('core/manifest.json'))->version;

        ZipCore::zipDir("core", "archives/$current_version.zip");
        $mod->deleteDirectory("core");

        $cms->unpack("/archives/$new_version.zip", "/core");

        $cm->coreChangeStatusToInactive($current_version);
        $cm->coreChangeStatusToActive($new_version);

        CmHelper::clearRequest();

        return GridView::widget($this->setOptions(CoreHandler::getCore()))->run();
    }

    public function actionDeleteCore()
    {
        $version = json_decode($_POST['data'])->version;
        unlink("archives/$version.zip");

        $mods = json_decode(file_get_contents('mods.json'));
        foreach ($mods->__core as $key => $item)
            if($item->version == $version) {
                unset($mods->__core[$key]);
                break;
            }
        file_put_contents('mods.json', json_encode($mods));

        return GridView::widget($this->setOptions(CoreHandler::getCore()))->run();
    }

    public function actionArchiveCore()
    {
        $current_version = $_GET['name'];
        ZipCore::zipDir("core", "archives/$current_version.zip");
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
                        $version = $model->version;
                        $fl = 0;

                        if ($model->localStatus == 'local')
                            $fl = 1;
                        if ($model->localStatus == 'server' && $fl == 0)
                            return GridViewHelper::button("download-$version", '__cjax', 'Скачать',
                                'cloud-download-alt', 'data-name="' . $version . '" data-version="' . $version
                                . '" data-action="download-core" data-target="cjax"');
//                        elseif ($model->localStatus == 'local')
//                            return GridViewHelper::button("update-$version", '__cjax', 'Обновить',
//                                'redo', 'data-name="' . $version . '" data-version="' . $version
//                                . '" data-action="update-core" data-target="cjax"');
                        else return GridViewHelper::div('<i class="far fa-hdd"></i>', 'fixed-width');
                    }
                ],
                'upload' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $version = $model->version;

                        return ($model->localStatus == 'local')
                            ? GridViewHelper::button("core-upload-$version", '__cjax', 'Загрузить в облако',
                                'cloud-upload-alt', 'data-name="' . $version . '" data-version="' . $model->version
                                . '" data-action="core-upload" data-target="cjax"')
                            : GridViewHelper::div('', 'fixed-width');
                    }
                ],
                'toggle' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $version = $model->version;

                        if ($model->status == 'active')
                            return GridViewHelper::button("", '', '', 'toggle-on', '');
                        elseif ($model->status == 'inactive')
                            return GridViewHelper::button("core-set-active-$version", '__cjax', 'Включить',
                                'toggle-off', 'data-name="' . $version . '" data-version="' . $model->version
                                . '" data-action="set-active-core" data-target="cjax"');
                        else
                            return GridViewHelper::div('', 'fixed-width');
                    },
                ],
                'delete' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $version = $model->version;

                        return ($model->status == 'inactive')
                            ? GridViewHelper::button("core-delete-$version", '__cjax', 'Удалить',
                                'trash', 'data-name="' . $version . '" data-version="' . $model->version
                                . '" data-action="delete-core" data-target="cjax"')
                            : GridViewHelper::div('', 'fixed-width');
                    },
                ],
                'version' => [
                    'label' => 'Версия',
                    'value' => function ($model) {
                        return GridViewHelper::select($model, '__cjax', 'data-name="'
                            . $model->version . '" data-action="change-version" data-target="cjax"');
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
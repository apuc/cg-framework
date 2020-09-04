<?php


namespace workspace\controllers;


use core\Controller;
use core\GridView;
use core\GridViewHelper;
use core\modules\Modules;
use core\modules\ModulesHandler;
use core\modules\ModulesSearchRequest;

class ModulesController extends Controller
{
    public function actionModuleUpload()
    {
        $module = new ModulesHandler();
        $module->upload();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionModuleDownload()
    {
        $module = new ModulesHandler();
        $module->download();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionModuleUpdate()
    {
        $module = new ModulesHandler();
        $module->update();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionSetActive()
    {
        $module = new ModulesHandler();
        $module->active();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionSetInactive()
    {
        $module = new ModulesHandler();
        $module->inactive();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionModuleDelete()
    {
        $module = new ModulesHandler();
        $module->delete();
        $module->clearRequest();

        $request = new ModulesSearchRequest();

        $model = $module->getAllModules();
        $model = Modules::search($request, $model);

        return GridView::widget($this->setModulesOptions($model))->run();
    }

    public function actionAddLocalModulesToManifest()
    {
        $module = new ModulesHandler();
        $module->addToManifest();

        $this->redirect('modules');
    }

    public function actionChangeVersion()
    {
        $mh = new ModulesHandler();

        return GridView::widget($this->setModulesOptions($mh->versionChanged()))->run();
    }

    public function actionModules()
    {
        $this->view->setTitle('Modules');

        $modules = new ModulesHandler();
        $request = new ModulesSearchRequest();

        $model = $modules->getAllModules();
        $model = Modules::search($request, $model);

        return $this->render('main/modules.tpl', ['options' => $this->setModulesOptions($model)]);
    }

    public function setModulesOptions($data)
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
                        $name = $model[0]->name;
                        $version = $model[0]->version;
                        $localStatus = $model[0]->localStatus;
                        $fl = 0;
                        foreach ($model as $item)
                            if ($item->localStatus == 'local')
                                $fl = 1;
                        if ($localStatus == 'server' && $fl == 0)
                            return GridViewHelper::button("download-$name", '__cjax', 'Скачать',
                                'cloud-download-alt', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="module-download" data-target="cjax"');
                        elseif ($localStatus == 'local')
                            return GridViewHelper::button("update-$name", '__cjax', 'Обновить',
                                'redo', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="module-update" data-target="cjax"');
                        else return GridViewHelper::div('', 'fixed-width');
                    }
                ],
                'upload' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model[0]->name;

                        return ($model[0]->localStatus == 'local')
                            ? GridViewHelper::button("upload-$name", '__cjax', 'Загрузить в облако',
                                'cloud-upload-alt', 'data-name="' . $name . '" data-version="' . $model[0]->version
                                . '" data-action="module-upload" data-target="cjax"')
                            : GridViewHelper::div('', 'fixed-width');
                    }
                ],
                'toggle' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model[0]->name;
                        $version = $model[0]->version;
                        $status = $model[0]->status;

                        if ($status == 'active')
                            return GridViewHelper::button("set-inactive-$name", '__cjax', 'Отключить',
                                'toggle-on', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="module-set-inactive" data-target="cjax"');
                        elseif ($status == 'inactive')
                            return GridViewHelper::button("set-active-$name", '__cjax', 'Включить',
                                'toggle-off', 'data-name="' . $name . '" data-version="' . $version
                                . '" data-action="module-set-active" data-target="cjax"');
                        else
                            return GridViewHelper::div('', 'fixed-width');
                    },
                ],
                'delete' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $name = $model[0]->name;

                        return ($model[0]->localStatus == 'local')
                            ? GridViewHelper::button("delete-$name", '__cjax', 'Удалить',
                                'trash', 'data-name="' . $name . '" data-version="' . $model[0]->version
                                . '" data-action="module-delete" data-target="cjax"')
                            : GridViewHelper::div('', 'fixed-width');
                    },
                ],
                'status' => [
                    'label' => 'Статус',
                    'value' => function ($model) {
                        return ($model[0]->localStatus == 'server')
                            ? GridViewHelper::div('not downloaded')
                            : GridViewHelper::div($model[0]->status);
                    }
                ],
                'name' => [
                    'label' => 'Название',
                    'value' => function ($model) {
                        return GridViewHelper::div($model[0]->name);
                    }
                ],
                'description' => [
                    'label' => 'Описание',
                    'value' => function ($model) {
                        return GridViewHelper::div($model[0]->description);
                    }
                ],
                'version' => [
                    'label' => 'Версия',
                    'value' => function ($model) {
                        return GridViewHelper::select($model, '__cjax', 'data-name="'
                            . $model[0]->name . '" data-action="change-version" data-target="cjax"');
                    }
                ]
            ],
            'baseUri' => 'modules',
        ];
    }
}
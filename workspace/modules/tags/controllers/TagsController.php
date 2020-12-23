<?php

namespace workspace\modules\tags\controllers;


use core\App;
use core\Controller;
use core\Debug;
use core\Select2;
use mysql_xdevapi\DocResult;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\requests\TagRequest;
use workspace\modules\tags\requests\TagRequestEdit;
use workspace\modules\tags\requests\TagsRequestSearch;
use workspace\modules\tags\services\TagsService;


class TagsController extends Controller
{
    public $service;

    protected function init()
    {
        $this->service = new TagsService();
        $this->viewPath = '/modules/tags/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Tags', 'url' => 'tags']);
    }


    public function actionStore()
    {
        $request = new TagRequest();

        if ($request->validate()) {
            $this->service->createTag($request);
            $this->redirect('tags');
        } else {

            $sel2 = new Select2();
            $sel2->setParams(Tag::getStatusLabel(), [
                'label' => 'Статус:',
                'id' => 'status',
                'class' => '',
            ], [0]);

            $selectList = $sel2->run();

            $errors = $request->isPost() ? $request->errors->all() : null;
            return $this->render('tags/store.tpl', ['errors' => $errors, 'statusSelect' => $selectList]);
        }
    }


    public function actionIndex()
    {
        $model = TagsService::searchTag(new TagsRequestSearch());

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model),  'h1' => 'Тэги']);
    }

    public function actionView($id)
    {
        $model = TagsService::getTagById($id);

        //TODO
        $model->status = Tag::getStatusLabel()[$model->status];

        $options = [
            'fields' => [
                'name' => 'Имя тега',
                'slug' => 'Slug тега',
                'status' => 'Статус'
            ],
        ];

        return $this->render('tags/view.tpl', ['model' => $model, 'options' => $options]);
    }


    public function actionDelete()
    {
        $request = new TagsRequestSearch();

        TagsService::deleteTag($request);

        $model = Tag::search($request);

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Тэги']);
    }

    public function actionEdit($id)
    {
        $request = new TagRequestEdit();

        if ($request->validate()) {
            $request->id = $id;
            $this->service->editTag($request);
            $this->redirect('tags');
        } else {
            $tagModel = TagsService::getTagById($id);

            $sel2 = new Select2();
            $sel2->setParams(Tag::getStatusLabel(), [
                'label' => 'Статус:',
                'id' => 'status',
                'class' => '',
            ], [$tagModel->status]);
            $selectList = $sel2->run();

            $errors = $request->isPost() ? $request->errors->all() : null;
            return $this->render('tags/edit.tpl',
                ['model' => $tagModel, 'h1' => 'Редактировать Тэг', 'errors' => $errors, 'statusSelect' => $selectList]);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function setOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'name' => 'Тег',
                'slug' => 'Slug',
                'status' => [//TODO status
                    'label' => 'Статус',
                    'filterType' => 'select',
                    /*'filterHtml' => Select2::widget()->setParams(Tag::getStatusLabel(), [
                        'id' => 'status',
                        'class' => ' __filter',
                    ], [])->run(),*/
                    'selectOptions' => '<option></option>
                                    <option value="1">Активен</option>
                                    <option value="0">Неактивен</option>',
                    'value' => function($model){
                            return Tag::getStatusLabel()[$model->status];
                    }
                ]
            ],
            'baseUri' => '/tags',
        ];
    }

}
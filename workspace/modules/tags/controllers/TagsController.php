<?php

namespace workspace\modules\tags\controllers;


use core\App;
use core\Controller;
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
            $errors = $request->isPost() ? $request->errors->all() : null;
            return $this->render('tags/store.tpl', ['errors' => $errors]);
        }
    }


    public function actionIndex()
    {
        $model = TagsService::searchTag(new TagsRequestSearch());

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Тэги']);
    }

    public function actionView($id)
    {
        $model = TagsService::getTagById($id);

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

            $errors = $request->isPost() ? $request->errors->all() : null;
            return $this->render('tags/edit.tpl',
                ['model' => $tagModel, 'h1' => 'Редактировать Тэг', 'errors' => $errors]);
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
                'status' => 'Status'
            ],
            'baseUri' => '/tags',
        ];
    }

}
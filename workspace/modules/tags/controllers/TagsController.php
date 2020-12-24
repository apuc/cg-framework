<?php

namespace workspace\modules\tags\controllers;


use core\App;
use core\Controller;
use core\Debug;
use core\Select2;
use mysql_xdevapi\DocResult;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\models\Type;
use workspace\modules\tags\requests\TagRequest;
use workspace\modules\tags\requests\TagRequestEdit;
use workspace\modules\tags\requests\TagsRequestSearch;
use workspace\modules\tags\services\TagsService;

/**
 * Class TagsController
 * @package workspace\modules\tags\controllers
 * @var TagsService $service
 */
class TagsController extends Controller
{
    public $service;

    /**
     * initialization
     */
    protected function init()
    {
        $this->service = new TagsService();
        $this->viewPath = '/modules/tags/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Tags', 'url' => 'tags']);
    }

    /**
     * Adding tag
     * @return false|string
     */
    public function actionStore()
    {
        $request = new TagRequest();
        $errors = array();

        $sel2 = new Select2();
        $sel2->setParams(Tag::getStatusLabel(), [
            'label' => 'Статус:',
            'id' => 'status',
            'class' => '',
        ], [0]);
        $selectList = $sel2->run();

        if ($request->validate()) {

            if($this->service->createTag($request))
                $this->redirect('tags');
            else {
                array_push($errors, "Такой Slug уже существует. 
                                                    Введите другой или оставьте его пустым и измените имя.");

                return $this->render('tags/store.tpl', ['errors' => $errors, 'statusSelect' => $selectList]);
            }
        } else {
            $errors = $request->isPost() ? $request->errors->all() : null;

            return $this->render('tags/store.tpl', ['errors' => $errors, 'statusSelect' => $selectList]);
        }
    }

    /**
     * Show all tags
     * @return false|string
     */
    public function actionIndex()
    {
        $model = TagsService::searchTag(new TagsRequestSearch());

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model),  'h1' => 'Тэги']);
    }

    /**
     * Show tag by id
     * @param $id
     * @return false|string
     */
    public function actionView($id)
    {
        $model = TagsService::getTagById($id);

        $options = [
            'fields' => [
                'name' => 'Имя тега',
                'slug' => 'Slug тега',
                'status' => [
                    'label' => 'Статус',
                    'value' => function($model){
                        return Tag::getStatusLabel()[$model->status];
                    }
                ],
                'type' => [
                    'label' => 'Тип',
                    'value' => function($model){
                        $typeList = array();
                        foreach (Type::getTypesByTagID($model->id) as $typeModel) {
                            if(isset(Tag::getTypeLabel()[$typeModel->type]))
                                array_push($typeList, Tag::getTypeLabel()[$typeModel->type]);
                            else    //TODO
                                array_push($typeList, "Отсутствует");
                        }
                        return implode(', ', $typeList);
                    }
                ]
            ],
        ];

        return $this->render('tags/view.tpl', ['model' => $model, 'options' => $options]);
    }

    /**
     * Delete tag by tag in request
     * @return false|string
     */
    public function actionDelete()
    {
        $request = new TagsRequestSearch();

        $errors = NULL;
        if(TagsService::deleteTag($request)){
            $errors = array();
            array_push($errors, "Удаление не вышло из-за SQL-ошибки.");
            array_push($errors, $request->errors->all());
        }
        $model = Tag::search($request);

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Тэги', 'errors' => $errors]);
    }

    /**
     * Edit tag
     * @param $id
     * @return false|string
     */
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
     * Set options
     *
     * Options are needed to display table of tags
     *
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
                'status' => [
                    'label' => 'Статус',
                    'filterType' => 'select',
                    'selectOptions' => [
                        '2' => 'Всё', //TODO
                        '1' => 'Активен',
                        '0' => 'Неактивен'
                    ],
                    'value' => function($model){
                            return Tag::getStatusLabel()[$model->status];
                    }
                ],
            ],
            'baseUri' => '/tags',
        ];
    }

}
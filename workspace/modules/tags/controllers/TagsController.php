<?php

namespace workspace\modules\tags\controllers;


use core\App;
use core\component_manager\lib\Config;
use core\Controller;
use core\Debug;
use Illuminate\Support\Facades\DB;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\models\Type;
use workspace\modules\tags\requests\TagsRequest;
use Illuminate\Database\Capsule\Manager as Capsule; //TODO

class TagsController extends Controller
{

    public $request = TagsRequest::class;

    public $tag = Tag::class;

    public $type = Type::class;


    protected function init()
    {
        $this->request = new $this->request();
        $this->tag = new $this->tag();
        $this->type = new $this->type();
        $this->viewPath = '/modules/tags/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Tags', 'url' => 'tags']);
    }


    public function actionStore()
    {
        if($this->request->name && $this->request->type && $this->request->type_id
            && $this->request->status) {

            $tagModel = new $this->tag();
            $typeModel = new $this->type();

            $tagModel->name = $this->request->name;

            if($this->request->slug) {
                $tagModel->slug = $this->request->slug;
            }
            else{
                $tagModel->slug = $tagModel->makeSlug($this->request->name);
            }

            $tagModel->status = (int)$this->request->status;
            $tagModel->save();

            $typeModel->type = $this->request->type;
            $typeModel->type_id = $this->request->type_id;
            $typeModel->tag_id = $tagModel->id;
            $typeModel->save();

            $this->redirect('tags');
        } else {
            return $this->render('tags/store.tpl');
        }
    }


    public function actionIndex()
    {
        $model = Tag::search($this->request);

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Тэги']);
    }

    public function actionView($id)
    {
        $model = $this->tag::where('id', $id)->first();

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
        $model = Tag::search($this->request);

        App::$db->capsule->getConnection()->transaction(function (){
            Type::getTypesByTagID($this->request->id)->delete();
            $this->tag->where('id', $this->request->id)->delete();
        });

        return $this->render('tags/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Тэги']);
    }

    public function actionEdit($id)
    {
        $tagModel = Tag::where('id', $id)->first();

        if($this->request->name || $this->request->status || $this->request->slug) {

            if($this->request->name)
                $tagModel->name = $this->request->name;

            if($this->request->slug)
                $tagModel->slug = $this->request->slug;

            if($this->request->status)
                $tagModel->status = (int)$this->request->status;

            $tagModel->save();

            $this->redirect('tags');

        } else {

            return $this->render('tags/edit.tpl',
                ['model' => $tagModel, 'h1' => 'Редактировать Тэг']);
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
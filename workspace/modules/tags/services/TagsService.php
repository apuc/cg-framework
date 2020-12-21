<?php

namespace workspace\modules\tags\services;

use core\App;
use core\Debug;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\models\Type;
use workspace\modules\tags\requests\TagsRequestSearch;

class TagsService
{

    public $tag = Tag::class;

    public $type = Type::class;

    public function __construct(){
        $this->tag = new $this->tag();
        $this->type = new $this->type();
    }

    public static function createTag($request)
    {
        $tagModel = new Tag();
        $typeModel = new Type();

        $tagModel->name = $request->name;

        if ($request->slug) {
            $tagModel->slug = $request->slug;
        } else {
            $tagModel->slug = $tagModel->makeSlug($request->name);
        }

        $tagModel->status = $request->status;
        $tagModel->save();

        $typeModel->type = $request->type;
        $typeModel->type_id = $request->type_id;
        $typeModel->tag_id = $tagModel->id;
        $typeModel->save();
    }

    public static function deleteTag($request){
        $res = App::$db->capsule->getConnection()->transaction(function () use ($request) {
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
        })->callback;
        var_dump($res);
    }

    public static function editTag($request){
        $tagModel = self::getTagById($request->id);

        $tagModel->name = $request->name;

        if ($request->slug) {
            $tagModel->slug = $request->slug;
        } else {
            $tagModel->slug = $tagModel->makeSlug($request->name);
        }
        $tagModel->status = $request->status;
        $tagModel->save();
    }

    public static function getTagById($id){
        return Tag::where('id', $id)->first();
    }

    public static function searchTag(TagsRequestSearch $request){
        return Tag::search($request);
    }

}
<?php

namespace workspace\modules\tags\services;

use core\App;
use core\Debug;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\models\Type;
use workspace\modules\tags\requests\TagsRequestSearch;

class TagsService
{

    public $tag;

    public $type;

    public function __construct()
    {
        $this->tag = new Tag();
        $this->type = new Type();
    }

    public function createTag($request)
    {
        $this->tag->name = $request->name;

        if ($request->slug) {
            $this->tag->slug = $request->slug;
        } else {
            $this->tag->slug = $this->tag->makeSlug($request->name);
        }

        $this->tag->status = $request->status;
        $this->tag->save();

        $this->type->type = $request->type;
        $this->type->type_id = $request->type_id;
        $this->type->tag_id = $this->tag->id;
        $this->type->save();
    }

    public static function deleteTag($request)
    {/*
        App::$db->capsule->getConnection()->transaction(function () use ($request) {
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
        });*/
        try{
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
        } catch (\Exception $e){
            echo $e;
            return false;
        }

    }

    public function editTag($request)
    {
        $this->tag = self::getTagById($request->id);

        $this->tag->name = $request->name;

        if ($request->slug) {
            $this->tag->slug = $request->slug;
        } else {
            $this->tag->slug = $this->tag->makeSlug($request->name);
        }
        $this->tag->status = $request->status;
        $this->tag->save();
    }

    public static function getTagById($id)
    {
        return Tag::where('id', $id)->first();
    }

    public static function searchTag(TagsRequestSearch $request)
    {
        return Tag::search($request);
    }

}
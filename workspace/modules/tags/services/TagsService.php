<?php

namespace workspace\modules\tags\services;

use core\App;
use core\Debug;
use workspace\modules\tags\models\Tag;
use workspace\modules\tags\models\Type;
use workspace\modules\tags\requests\TagsRequestSearch;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagsService
{
    use SoftDeletes;

    /**
     * @var Tag
     */
    public $tag;

    /**
     * @var Type
     */
    public $type;

    /**
     * TagsService constructor.
     */
    public function __construct()
    {
        $this->tag = new Tag();
        $this->type = new Type();
    }

    /**
     * Adding new tag
     *
     * Also adding new row in tags_relation
     *
     * @param $request
     * @return bool
     */
    public function createTag($request)
    {
        //TODO Если инкапсулировать slug, нужно делать проверки на само имя
        if(NULL == Tag::withTrashed()->where('slug', $request->slug)->first()
                && ((!$request->slug) ?
                (NULL == Tag::withTrashed()->where('slug', Tag::makeSlug($request->name))->first()) : true)){

            $this->tag->name = $request->name;

            if ($request->slug) {
                $this->tag->slug = $request->slug;
            } else {
                $this->tag->slug = Tag::makeSlug($request->name);
            }

            $this->tag->status = $request->status;
            $this->tag->save();

            $this->type->type = $request->type;
            $this->type->type_id = $request->type_id;
            $this->type->tag_id = $this->tag->id;
            $this->type->save();

            return true;
        } else {

            return false;
        }
    }

    /**
     * Deleting tag
     *
     * Cascade delete includes rows from tags_relations
     *
     * @param $request
     * @throws \Throwable
     */
    public static function deleteTag($request)
    {
        /*
        App::$db->capsule->getConnection()->transaction(function () use ($request) {
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
        });
        */

        App::$db->capsule->getConnection()->beginTransaction();
        try {
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
            App::$db->capsule->getConnection()->commit();

            $success = true;
        } catch (\Exception $e) {
            $success = false;
            App::$db->capsule->getConnection()->rollBack();
        }

        return $success;
    }

    /**
     * Edit tag
     * @param $request
     */
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

    /**
     * Returns tag by id
     * @param $id
     * @return mixed
     */
    public static function getTagById($id)
    {
        return Tag::where('id', $id)->first();
    }

    /**
     * Searching tag
     * @param TagsRequestSearch $request
     * @return \Illuminate\Database\Eloquent\Collection|Tag[]
     */
    public static function searchTag(TagsRequestSearch $request)
    {
        return Tag::search($request);
    }

}
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
     * Also adding new row in tags_relations
     *
     * @param $request
     */
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
        App::$db->capsule->getConnection()->transaction(function () use ($request) {
            Type::getTypesByTagID($request->id)->delete();
            Tag::where('id', $request->id)->delete();
        });
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
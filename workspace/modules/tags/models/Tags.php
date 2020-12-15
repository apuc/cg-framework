<?php

namespace workspace\modules\tags\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\tags\requests\TagsSearchRequest;


class Tags extends Model
{
    protected $table = "tags";

    public $fillable = ['name', 'slug', 'type', 'type_id', 'status'];

    /**
     * @param TagsSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(TagsSearchRequest $request)
    {
        $query = self::query();

        if ($request->name)
            $query->where('name', 'LIKE', "%$request->name%");

        if ($request->slug)
            $query->where('slug', 'LIKE', "%$request->slug%");

        if ($request->type)
            $query->where('type', 'LIKE', "$request->type");

        if ($request->type_id)
            $query->where('type_id', 'LIKE', "$request->type_id");

        return $query->get();
    }

    public static function getCurrentTagName()
    {
        return $_SESSION['name'] ?? null;
    }

    public function _save($request)
    {
        $this->name = $request->name;
        $this->slug = $request->slug;
        $this->type = $request->type;
        $this->type_id = $request->type_id;
        $this->save();
    }
}
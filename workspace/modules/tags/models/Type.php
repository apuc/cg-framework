<?php


namespace workspace\modules\tags\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\tags\requests\TagsRequest;
use workspace\modules\tags\requests\TypesRequest;

class Type extends Model
{
    protected $table = "tags_relations";

    public $fillable = ['type', 'type_id', 'tag_id'];


    public static function search(TagsRequest $request)
    {
        $query = self::query();

        if ($request->type)
            $query->where('type', 'LIKE', "%$request->type%");

        if ($request->type_id)
            $query->where('type_id',$request->type_id);

        if ($request->tag_id)
            $query->where('tag_id', $request->tag_id);

        return $query->get();
    }

    public function _save($request)
    {
        $this->type = $request->type;
        $this->tag_id = $request->tag_id;
        $this->type_id = $request->type_id;
        $this->save();
    }

}
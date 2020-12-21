<?php


namespace workspace\modules\tags\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\tags\requests\TagsRequestSearch;

class Type extends Model
{
    protected $table = "tags_relations";

    public $fillable = ['type', 'type_id', 'tag_id'];


    public static function search(TagsRequestSearch $request)
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


    public static function getTypesByTagID($id){
        return Type::where('tag_id', $id);
    }

    public function _save($request)
    {
        $this->type = $request->type;
        $this->tag_id = (int)$request->tag_id;
        $this->type_id = (int)$request->type_id;
        $this->save();
    }

}
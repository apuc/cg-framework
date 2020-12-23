<?php

namespace workspace\modules\tags\models;


use core\Debug;
use Illuminate\Database\Eloquent\Model;
use workspace\modules\tags\requests\TagsRequestSearch;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{
    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_POST = 'post';
    const TYPE_ARTICLE = 'article';
    const TYPE_COMMENT = 'comment';



    protected $table = "tags";

    public $fillable = ['name', 'slug', 'status'];


    protected $cascadeDeletes = ['comments'];
    protected $dates = ['deleted_at'];


    public static function getStatusLabel(){
        return [ self::STATUS_DISABLE => 'Неактивен', self::STATUS_ACTIVE => 'Активен'];
    }

    public static function getTypeLabel(){
        return [
            self::TYPE_ARTICLE => 'Статья',
            self::TYPE_COMMENT => 'Комментарий',
            self::TYPE_POST => 'Пост'
        ];
    }

    /**
     * @param TagsRequestSearch $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(TagsRequestSearch $request)
    {
        $query = self::query();

        if ($request->id)
            $query->where('id', $request->id);

        if ($request->name)
            $query->where('name', 'LIKE', "%$request->name%");

        if ($request->slug)
            $query->where('slug', 'LIKE', "%$request->slug%");

        if (NULL !== $request->status && 2 != $request->status)
            $query->where('status', $request->status);

        return $query->get();
    }

    function makeSlug($string){
        return $slug = \Transliterator::createFromRules(
            ':: Any-Latin;'
            . ':: NFD;'
            . ':: [:Nonspacing Mark:] Remove;'
            . ':: NFC;'
            . ':: [:Punctuation:] Remove;'
            . ':: Lower();'
            . '[:Separator:] > \'-\''
        )
            ->transliterate( $string );
    }

    public function _save($request)
    {
        $this->name = $request->name;
        $this->slug = $request->slug;
        $this->status = (int)$request->type;
        $this->save();
    }

}
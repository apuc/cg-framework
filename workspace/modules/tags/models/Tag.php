<?php

namespace workspace\modules\tags\models;


use core\Debug;
use Illuminate\Database\Eloquent\Model;
use workspace\modules\tags\requests\TagsRequestSearch;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package workspace\modules\tags\models
 */
class Tag extends Model
{

    protected $softDelete = true;

    /**
     * define status values
     */
    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * define type values
     */
    const TYPE_POST = 'post';
    const TYPE_ARTICLE = 'article';
    const TYPE_COMMENT = 'comment';


    /**
     * name of tag table
     * @var string
     */
    protected $table = "tags";

    /**
     * columns of table
     * @var string[]
     */
    public $fillable = ['name', 'slug', 'status'];

    /**
     *
     * @var string[] $dates
     */
    protected $dates = ['deleted_at'];

    /**
     * Returns the match between the status number and its name
     *
     * @return string[]
     */
    public static function getStatusLabel(){
        return [ self::STATUS_DISABLE => 'Неактивен', self::STATUS_ACTIVE => 'Активен'];
    }

    /**
     * Returns the match between the type value and its name
     *
     * @return string[]
     */
    public static function getTypeLabel(){
        return [
            self::TYPE_ARTICLE => 'Статья',
            self::TYPE_COMMENT => 'Комментарий',
            self::TYPE_POST => 'Пост'
        ];
    }

    /**
     * Search tag
     *
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


    /**
     * Making slug from tag name
     *
     * @param $string
     * @return false|string
     */
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

    /**
     * Adding new tag to table
     * @param $request
     */
    public function _save($request)
    {
        $this->name = $request->name;
        $this->slug = $request->slug;
        $this->status = (int)$request->type;
        $this->save();
    }

}
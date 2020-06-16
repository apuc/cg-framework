<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\categories\requests\CategorySearchRequest;

class Category  extends Model
{
    protected $table = "category";

    public $fillable = ['category'];

    /**
     * @param CategorySearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(CategorySearchRequest $request)
    {
        $query = self::query();

        if ($request->category) {
            $query->where('category', 'LIKE', "%$request->category%");
        }

        return $query->get();
    }
}
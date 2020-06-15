<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\product\requests\ProductSearchRequest;

class Product extends Model
{
    protected $table = "product";
    public $fillable = ['name', 'title', 'description', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vp()
    {
        return $this->hasMany('workspace\modules\product\models\VirtualProduct');
    }

    /**
     * @param ProductSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(ProductSearchRequest $request)
    {
        $query = self::query();
        $query->with('vp');

        if ($request->name) {
            $query->where('name', 'LIKE', "%$request->name%");
        }
        if ($request->price) {
            $query->whereHas('vp', function ($q) use ($request){
                $q->where('price', 'LIKE', "%$request->price%");
            });
        }

        return $query->get();
    }
}
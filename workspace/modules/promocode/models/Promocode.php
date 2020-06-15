<?php


namespace workspace\modules\promocode\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\promocode\requests\PromocodeSearchRequest;

class Promocode extends Model
{
    protected $table = "promocode";
    public $fillable = ['name', 'discount','active_from','active_to'];

    public static function search(PromocodeSearchRequest $request)
    {
        $query = self::query();

        if ($request->name) {
            $query->where('name', 'LIKE', "%$request->name%");
        }
        if ($request->discount) {
            $query->where('discount', 'LIKE', "%$request->discount%");
        }
        if ($request->active_from) {
            $query->where('active_from', 'LIKE', "%$request->active_from%");
        }
        if ($request->active_to) {
            $query->where('active_to', 'LIKE', "%$request->active_to%");
        }

        return $query->get();
    }

}
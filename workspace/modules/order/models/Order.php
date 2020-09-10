<?php


namespace workspace\modules\order\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\order\requests\OrderSearchRequest;

class Order extends Model
{
    protected $table = "order";
    public $fillable = ['city', 'email','fio','phone','pay','delivery','shop_id','delivery_date','delivery_time','address','comment','total_price'];

    /**
     * @param OrderSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(OrderSearchRequest $request)
    {
        $query = self::query();

        if ($request->id) {
            $query->where('id', 'LIKE', "%$request->id%");
        }
        if ($request->fio) {
            $query->where('fio', 'LIKE', "%$request->fio%");
        }
        if ($request->email) {
            $query->where('email', 'LIKE', "%$request->email%");
        }
        if ($request->phone) {
            $query->where('phone', 'LIKE', "%$request->phone%");
        }

        return $query->get();
    }

}
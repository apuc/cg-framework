<?php


namespace workspace\modules\order\models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    public $fillable = ['city', 'email','fio','phone','pay','delivery','shop_id','delivery_date','delivery_time','address','comment','total_price'];
}
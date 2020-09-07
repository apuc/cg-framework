<?php


namespace workspace\modules\order\models;


use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;
    protected $table = "order_product";
    public $fillable = ['order_id', 'product_id', 'quantity'];
}
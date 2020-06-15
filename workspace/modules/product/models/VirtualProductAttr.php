<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class VirtualProductAttr extends Model
{
    protected $table = "virtual_product_attr";
    public $fillable = ['attr_value_id', 'virtual_product_id','status'];
}
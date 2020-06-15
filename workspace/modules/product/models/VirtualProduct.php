<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class VirtualProduct extends Model
{
    protected $table = "virtual_product";
    public $fillable = ['product_id', 'price'];
}
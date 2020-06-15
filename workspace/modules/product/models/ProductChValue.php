<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class ProductChValue extends Model
{
    protected $table = "product_ch_value";
    public $fillable = ['product_id', 'ch_value_id'];
}
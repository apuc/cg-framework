<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $table = "product_cat";
    public $fillable = ['product_id', 'cat_id'];
}
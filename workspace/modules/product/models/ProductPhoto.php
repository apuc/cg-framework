<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = "product_photo";
    public $fillable = ['product_id', 'photo'];
}
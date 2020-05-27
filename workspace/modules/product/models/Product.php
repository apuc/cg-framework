<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $fillable = ['name', 'title','description','status'];
}
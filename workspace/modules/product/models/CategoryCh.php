<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class CategoryCh extends Model
{
    protected $table = "category_ch";
    public $fillable = ['category_id', 'characteristic_id'];
}
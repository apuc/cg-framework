<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public $fillable = ['name', 'title','description','status'];
}
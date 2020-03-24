<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";

    public $fillable = ['name', 'text' , 'language_id', 'category_id', 'image_name', 'image'];
}
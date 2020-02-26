<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";

    public $fillable = ['name', 'article' , 'language_id'];

//    public $name;
//    public $text;
//    public $language;
}
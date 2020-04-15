<?php


namespace workspace\models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = "article_category";

    public $fillable = ['article_id', 'category_id'];
}
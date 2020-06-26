<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class Category  extends Model
{
    protected $table = "category";

    public $fillable = ['category'];
}
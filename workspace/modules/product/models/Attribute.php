<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = "attribute";
    public $fillable = ['name'];
}
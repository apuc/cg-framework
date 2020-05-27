<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class AttrValue extends Model
{
    protected $table = "attr_value";
    public $fillable = ['attr_id', 'value'];
}
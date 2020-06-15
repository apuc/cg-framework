<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class ChValue extends Model
{
    protected $table = "ch_value";
    public $fillable = ['ch_id', 'value'];
}
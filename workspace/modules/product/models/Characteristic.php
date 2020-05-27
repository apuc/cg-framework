<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $table = "characteristic";
    public $fillable = ['name','status'];
}
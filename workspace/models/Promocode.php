<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = "promocode";
    public $fillable = ['name', 'discount','active_from','active_to'];
}
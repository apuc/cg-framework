<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "settings";

    public $fillable = ['key', 'value'];
}
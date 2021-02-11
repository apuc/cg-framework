<?php


namespace workspace\models;

use core\Debug;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = "rule";

    public $fillable = ['key'];
}
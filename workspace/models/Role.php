<?php

namespace workspace\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";

    public $fillable = ['key'];
}
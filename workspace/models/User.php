<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $fillable = ['username', 'email', 'role', 'password_hash'];

}
<?php


namespace workspace\models;

use core\Debug;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = "rule";

    public $fillable = ['key'];

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_rule_relations',
                                    'rule_key', 'role_name',
                                            'key', 'key');
    }
}
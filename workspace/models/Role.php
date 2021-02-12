<?php

namespace workspace\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";

    public $fillable = ['key'];


    public function rules(){
        return $this->belongsToMany(Rule::class, 'role_rule_relations',
                                'role_name', 'rule_key',
                                        'key', 'key');
    }
}
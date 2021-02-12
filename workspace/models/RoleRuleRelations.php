<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class RoleRuleRelations extends Model
{
    protected $table = "role_rule_relations";

    public $fillable = ['role_name', 'rule_key'];

    public function _save($role_name, $rule_key)
    {
        $this->role_name = $role_name;
        $this->rule_key = $rule_key;
        $this->save();
    }
}
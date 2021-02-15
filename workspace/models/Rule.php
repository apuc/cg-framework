<?php


namespace workspace\models;

use core\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Rule extends Model
{
    protected $table = "rule";

    public $fillable = ['key'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_rule_relations',
            'rule_key', 'role_name',
            'key', 'key');
    }

    public static function udpateRule($id, $key, $roles)
    {
        $rule = Rule::findOrFail($id);

        $rule->key = $_POST['key'];
        $rule->save();

        $rule->roles()->sync($roles);

    }

    public static function deleteRule($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->roles()->detach();
        $rule->delete();
    }
}
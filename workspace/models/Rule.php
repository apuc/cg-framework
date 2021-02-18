<?php


namespace workspace\models;

use core\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Rule extends Model
{
    protected $table = "rule";

    public $fillable = ['key'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_rule_relations',
            'rule_key', 'role_name',
            'key', 'key');
    }

    public static function storeRule($key, $roles)
    {
        $rule = new Rule();
        $rule->key = $key;
        $rule->save();

        $rule->roles()->attach($roles); // TODO check later sync > attach
    }

    public static function udpateRule($id, $key, $roles)
    {
        $rule = Rule::findOrFail($id);

        $rule->roles()->detach();

        $rule->key = $key;
        $rule->save();

        $rule->roles()->sync($roles);

    }

    public static function deleteRule($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->roles()->detach();
        $rule->delete();
    }

    /**
     * @param string $rule_key
     * @return Rule
     */
    public static function getRuleByKey(string $rule_key): Rule
    {
        $rule = Rule::where('key', $rule_key);

        if($rule->exists()){
            return $rule->first();
        } else {
            throw new ModelNotFoundException('Rule not found!');
        }
    }
}
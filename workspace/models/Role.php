<?php

namespace workspace\models;

use core\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $table = "role";

    public $fillable = ['key'];

    public static function storeRole($key, $rules, $users = null)
    {
        $role = new Role();
        $role->key = $_POST['key'];
        $role->save();

        $role->rules()->attach($rules); // TODO check later, sync > attach

        if (isset($users)) {
            $role->users()->attach($users); // TODO check later, sync > attach
        }
    }

    public static function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->rules()->detach();
        $role->users()->detach();
        $role->delete();
    }

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'role_rule_relations',
            'role_name', 'rule_key',
            'key', 'key');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role_relations',
            'role_key', 'user_name',
            'key', 'username');
    }

    public static function updateRole($id, $key, $rules = null, $users = null)
    {
        $role = Role::findOrFail($id);

        $role->key = $key;
        $role->save();

        if (isset($rules)) {
            $role->rules()->sync($rules);
        }
        if (isset($users)) {
            $role->users()->sync($users);
        }
    }

    public static function setRule(int $role_id, string $rule_key)
    {
        $role = Role::findOrFail($role_id);
        $role->rules()->syncWithoutDetaching($rule_key);
    }
}
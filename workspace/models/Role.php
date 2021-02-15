<?php

namespace workspace\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $table = "role";

    public $fillable = ['key'];

    public static function deleteRole($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->users()->detach();
            $role->delete();

            DB::commit();

            return true;
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();

            return false;
        }
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'role_rule_relations',
            'role_name', 'rule_key',
            'key', 'key');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_role_relations',
            'role_key', 'user_name',
            'key', 'username');
    }

    public static function updateRole($id, $key, $rules)
    {
        $role = Role::where('id', $id)->first();

        $role->key = $key;
        $role->save();

        $role->rules()->sync($rules);
    }
}
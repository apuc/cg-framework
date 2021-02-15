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

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_rule_relations',
                                    'rule_key', 'role_name',
                                            'key', 'key');
    }

    public static function deleteRule($id)
    {
        DB::beginTransaction();
        try {
            $rule = Rule::findOrFail($id);
            $rule->roles()->detach();
            $rule->delete();

            DB::commit();

            return true;
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();

            return false;
        }
    }
}
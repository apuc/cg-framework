<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;

class UserRoleRelations extends Model
{
    protected $table = "user_role_relations";

    public $fillable = ['user_name', 'role_key'];

    public function _save($user_name, $role_key)
    {
        $this->user_name = $user_name;
        $this->role_key = $role_key;
        $this->save();
    }

    public static function removeRole($username, $role_key)
    {
        $user = User::where('username', $username)->first();
        $user->roles->detach($role_key);
    }
}
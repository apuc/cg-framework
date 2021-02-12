<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use workspace\modules\users\requests\UsersSearchRequest;

class User extends Model
{
    protected $table = "user";

    public $fillable = ['username', 'email', 'password_hash'];

    public static function getCurrentUserName()
    {
        return $_SESSION['username'] ?? null;
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_role_relations',
                                    'user_name', 'role_key',
                                        'username', 'key');
    }

    public function getRules(){

        $roles = $this->roles()->getModels();

        $rules = new Collection();
        foreach ($roles as $role){
            $rules = $rules->merge($role->rules);
        }

        return $rules;
    }

    public static function search(UsersSearchRequest $request)
    {
        $query = self::query();

        if ($request->username)
            $query->where('username', 'LIKE', "%$request->username%");

        if ($request->email)
            $query->where('email', 'LIKE', "%$request->email%");

        return $query->get();
    }
}